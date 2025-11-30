<?php

declare(strict_types=1);

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

final class NotifChannelSettings extends Settings
{
    public bool $is_telegram_enabled;

    public string $telegram_token;

    public string $telegram_chatid;

    public bool $is_discord_enabled;

    public string $discord_token;

    public bool $is_mail_enabled;

    public string $mail_host;

    public string $mail_encryption;

    public int $mail_port;

    public string $mail_username;

    public string $mail_password;

    public static function group(): string
    {
        return 'notifChannel';
    }

    public static function encrypted(): array
    {
        return [
            'telegram_token',
            'telegram_chatid',
            'discord_token',
            'mail_username',
            'mail_password',
        ];
    }
}
