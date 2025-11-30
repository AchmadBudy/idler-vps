<?php

declare(strict_types=1);

namespace App\Services;

use App\Settings\NotifChannelSettings;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

final class NotificationService
{
    private NotifChannelSettings $settings;

    public function __construct(
        public string $subject,
        public string $message
    ) {
        $this->settings = app(NotifChannelSettings::class);
    }

    /**
     * Send notification to all enabled channels.
     */
    public function sendAll(): void
    {
        $this->sendDiscord();
        $this->sendTelegram();
        $this->sendEmail();
    }

    /**
     * Send notification via Discord Webhook.
     */
    public function sendDiscord(): bool
    {
        if (! $this->settings->is_discord_enabled || empty($this->settings->discord_token)) {
            return false;
        }

        try {
            // Asumsi discord_token adalah Webhook URL lengkap
            $response = Http::post($this->settings->discord_token, [
                'content' => $this->message,
            ]);

            return $response->successful();
        } catch (Exception $e) {
            Log::error('Discord Notification Error: '.$e->getMessage());

            return false;
        }
    }

    /**
     * Send notification via Telegram Bot.
     */
    public function sendTelegram(): bool
    {
        // Note: property 'is_telegram_enabled' sesuai typo di file Settings
        if (! $this->settings->is_telegram_enabled || empty($this->settings->telegram_token) || empty($this->settings->telegram_chatid)) {
            return false;
        }

        try {
            $url = "https://api.telegram.org/bot{$this->settings->telegram_token}/sendMessage";

            $response = Http::post($url, [
                'chat_id' => $this->settings->telegram_chatid,
                'text' => $this->message,
                'parse_mode' => 'HTML',
            ]);

            return $response->successful();
        } catch (Exception $e) {
            Log::error('Telegram Notification Error: '.$e->getMessage());

            return false;
        }
    }

    /**
     * Send notification via Email using Dynamic SMTP Settings.
     */
    public function sendEmail(): bool
    {
        if (! $this->settings->is_mail_enabled || empty($this->settings->mail_host)) {
            return false;
        }

        try {
            // Konfigurasi mailer baru secara dinamis
            $config = [
                'transport' => 'smtp',
                'host' => $this->settings->mail_host,
                'port' => $this->settings->mail_port,
                'encryption' => $this->settings->mail_encryption,
                'username' => $this->settings->mail_username,
                'password' => $this->settings->mail_password,
                'timeout' => null,
            ];

            // Set config untuk mailer sementara 'dynamic_notification'
            Config::set('mail.mailers.dynamic_notification', $config);

            // Kirim email menggunakan mailer tersebut
            Mail::mailer('dynamic_notification')->raw($this->message, function ($mail) {
                $mail->to($this->settings->mail_username) // Mengirim ke email admin (username) sebagai default
                    ->from($this->settings->mail_username, 'VPS Notification')
                    ->subject($this->subject);
            });

            return true;
        } catch (Exception $e) {
            Log::error('Email Notification Error: '.$e->getMessage());

            return false;
        }
    }
}
