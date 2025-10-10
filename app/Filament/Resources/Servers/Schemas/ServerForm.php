<?php

declare(strict_types=1);

namespace App\Filament\Resources\Servers\Schemas;

use App\Enums\CurrencyEnum;
use App\Enums\CycleTypeEnum;
use App\Enums\DataUnitEnum;
use App\Models\Provider;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class ServerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Server Details')
                    ->components([
                        TextInput::make('name')
                            ->label('Server Name')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('hostname')
                            ->label('Server Hostname')
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
                        TagsInput::make('ip_addresses_v4')
                            ->label('IPv4 Addresses')
                            ->columnSpanFull(),
                        TagsInput::make('ip_addresses_v6')
                            ->label('IPv6 Addresses')
                            ->columnSpanFull(),
                        TextInput::make('server_type')
                            ->label('Server Type (KVM, LXC, etc.)')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('os')
                            ->label('Operating System')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('cpu')
                            ->label('CPU Cores')
                            ->numeric()
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('cpu_model')
                            ->label('CPU Model')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('ram')
                            ->label('RAM')
                            ->numeric()
                            ->required()
                            ->columnSpan(2),
                        Select::make('ram_type')
                            ->label('RAM Unit')
                            ->options(DataUnitEnum::class)
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('disk')
                            ->label('Disk Space')
                            ->numeric()
                            ->required()
                            ->columnSpan(2),
                        Select::make('disk_type')
                            ->label('Disk Unit')
                            ->options(DataUnitEnum::class)
                            ->required()
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
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
