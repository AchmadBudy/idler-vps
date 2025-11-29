<?php

declare(strict_types=1);

namespace App\Filament\Resources\Domains\Schemas;

use App\Enums\CurrencyEnum;
use App\Enums\CycleTypeEnum;
use App\Models\Provider;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class DomainForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Domain Details')
                    ->components([
                        TextInput::make('domain_name')
                            ->label('Domain Name')
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
                        ToggleButtons::make('is_owned')
                            ->label('Is Owned')
                            ->default(false)
                            ->boolean()
                            ->grouped()
                            ->columnSpan(2),
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
