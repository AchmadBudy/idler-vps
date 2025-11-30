<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Settings\NotifChannelSettings;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

final class Settings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    protected string $view = 'filament.pages.settings';

    /**
     * icon
     */
    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsHorizontal;

    public function mount(NotifChannelSettings $settings): void
    {
        $this->form->fill([
            'is_telegram_enabled' => $settings->is_telegram_enabled,
            'telegram_token' => $settings->telegram_token,
            'telegram_chatid' => $settings->telegram_chatid,
            'is_discord_enabled' => $settings->is_discord_enabled,
            'discord_token' => $settings->discord_token,
            'is_mail_enabled' => $settings->is_mail_enabled,
            'mail_host' => $settings->mail_host,
            'mail_encryption' => $settings->mail_encryption,
            'mail_port' => $settings->mail_port,
            'mail_username' => $settings->mail_username,
            'mail_password' => $settings->mail_password,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Nofify Settings')
                    ->schema([
                        Toggle::make('is_telegram_enabled')
                            ->label('Telegram Enabled'),
                        TextInput::make('telegram_token')
                            ->label('Telegram Token'),
                        TextInput::make('telegram_chatid')
                            ->label('Telegram Chat ID'),

                        Toggle::make('is_discord_enabled')
                            ->label('Discord Enabled'),
                        TextInput::make('discord_token')
                            ->label('Discord Token'),

                        Toggle::make('is_mail_enabled')
                            ->label('Mail Enabled'),
                        TextInput::make('mail_host')
                            ->label('Mail Host'),
                        TextInput::make('mail_encryption')
                            ->label('Mail Encryption'),
                        TextInput::make('mail_port')
                            ->label('Mail Port'),
                        TextInput::make('mail_username')
                            ->label('Mail Username'),
                        TextInput::make('mail_password')
                            ->label('Mail Password')
                            ->password(),

                        Actions::make([
                            Action::make('Save')
                                ->translateLabel()
                                ->requiresConfirmation()
                                ->action('saveSettings'),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function saveSettings(NotifChannelSettings $settings): void
    {
        $data = $this->form->getState();

        $settings->is_telegram_enabled = $data['is_telegram_enabled'];
        $settings->telegram_token = $data['telegram_token'] ?? '';
        $settings->telegram_chatid = $data['telegram_chatid'] ?? '';
        $settings->is_discord_enabled = $data['is_discord_enabled'];
        $settings->discord_token = $data['discord_token'] ?? '';
        $settings->is_mail_enabled = $data['is_mail_enabled'];
        $settings->mail_host = $data['mail_host'] ?? 'smtp.gmail.com';
        $settings->mail_encryption = $data['mail_encryption'] ?? 'TLS';
        $settings->mail_port = $data['mail_port'] ?? 587;
        $settings->mail_username = $data['mail_username'] ?? '';
        $settings->mail_password = $data['mail_password'] ?? '';
        $settings->save();

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}
