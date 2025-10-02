<?php

declare(strict_types=1);

namespace App\Filament\Resources\Miscs\Schemas;

use App\Enums\CurrencyEnum;
use App\Enums\CycleTypeEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class MiscForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Misc Details')
                    ->components([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->columnSpan(2),
                        Select::make('provider_id')
                            ->label('Provider')
                            ->relationship('provider', 'name')
                            ->required()
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
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
