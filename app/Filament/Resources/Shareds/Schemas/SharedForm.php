<?php

declare(strict_types=1);

namespace App\Filament\Resources\Shareds\Schemas;

use App\Enums\CurrencyEnum;
use App\Enums\CycleTypeEnum;
use App\Models\Provider;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

final class SharedForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Shared Details')
                    ->components([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->columnSpan(2),
                        Select::make('provider_id')
                            ->label('Provider')
                            ->relationship('provider', 'name')
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('link')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Textarea::make('description')
                                    ->required()
                                    ->columns(3)
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                            ->createOptionUsing(fn (array $data): string => Provider::create([
                                ...$data,
                                'slug' => str($data['name'])->slug(),
                            ])->id
                            )
                            ->columnSpan(2),
                        TextInput::make('domain')
                            ->label('Domain')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('panel_type')
                            ->label('Panel Type')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('ipv4')
                            ->label('IPv4 Addresses')
                            ->columnSpan(2),
                        TextInput::make('ipv6')
                            ->label('IPv6 Addresses')
                            ->columnSpan(2),
                        TextInput::make('location')
                            ->label('Location')
                            ->required()
                            ->columnSpan(4),
                        DatePicker::make('owned_at')
                            ->label('Owned At')
                            ->required()
                            ->columnSpan(2),
                        DatePicker::make('due_at')
                            ->label('Due At')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->required()
                            ->columnSpan(2),
                        Select::make('price_currency')
                            ->label('Currency')
                            ->options(CurrencyEnum::class)
                            ->required()
                            ->columnSpan(1),
                        Select::make('cycle_type')
                            ->label('Billing Cycle')
                            ->options(CycleTypeEnum::class)
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('domains')
                            ->label('Domains')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('subdomains')
                            ->label('Subdomains')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('disk_in_gb')
                            ->label('Disk in GB')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('emails')
                            ->label('Emails Limit')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('bandwith_in_gb')
                            ->label('Bandwidth in GB')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('ftp')
                            ->label('FTP Accounts')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('databases')
                            ->label('Databases')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        ToggleButtons::make('is_owned')
                            ->label('Is Owned')
                            ->default(false)
                            ->boolean()
                            ->grouped()
                            ->columnSpan(1),
                        ToggleButtons::make('is_reseller')
                            ->label('Is Reseller')
                            ->boolean()
                            ->default(false)
                            ->grouped()
                            ->columnSpan(2)
                            ->live(),
                        TextInput::make('accounts')
                            ->label('Accounts')
                            ->numeric()
                            ->columnSpan(2)
                            ->visible(fn (Get $get): mixed => $get('is_reseller')),
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
