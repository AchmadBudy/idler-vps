<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('notifChannel.is_discord_enabled', false);
        $this->migrator->add('notifChannel.is_telegram_enabled', false);
        $this->migrator->add('notifChannel.is_mail_enabled', false);
        $this->migrator->addEncrypted('notifChannel.discord_token', '');
        $this->migrator->addEncrypted('notifChannel.telegram_token', '');
        $this->migrator->addEncrypted('notifChannel.telegram_chatid', '');
        $this->migrator->add('notifChannel.mail_host', 'smtp.gmail.com');
        $this->migrator->add('notifChannel.mail_port', 587);
        $this->migrator->add('notifChannel.mail_encryption', 'TLS');
        $this->migrator->addEncrypted('notifChannel.mail_username', '');
        $this->migrator->addEncrypted('notifChannel.mail_password', '');
    }
};
