<?php

declare(strict_types=1);

namespace App\Filament\Resources\Domains\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class DomainsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('domain_name')
                    ->label('Domain Name')
                    ->searchable(),
                TextColumn::make('provider.name')
                    ->label('Provider')
                    ->searchable(),
                TextColumn::make('owned_at')
                    ->label('Owned At')
                    ->date(),
                TextColumn::make('due_at')
                    ->label('Due At')
                    ->date(),
                TextColumn::make('price')
                    ->label('Price')
                    ->numeric(),
                TextColumn::make('price_currency')
                    ->label('Currency')
                    ->searchable(),
                TextColumn::make('cycle_type')
                    ->label('Billing Cycle')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
