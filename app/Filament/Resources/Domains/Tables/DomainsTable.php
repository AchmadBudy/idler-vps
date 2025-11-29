<?php

declare(strict_types=1);

namespace App\Filament\Resources\Domains\Tables;

use App\Models\Domain;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
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
                IconColumn::make('is_owned')
                    ->label('Is Owned')
                    ->boolean(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money(fn (Domain $record): string => $record->price_currency->value)
                    ->sortable(),
                TextColumn::make('cycle_type')
                    ->label('Billing Cycle')
                    ->searchable(),
                TextColumn::make('owned_at')
                    ->label('Owned At')
                    ->date(),
                TextColumn::make('due_at')
                    ->label('Due At')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('Extend Duration')
                    ->icon('heroicon-o-clock')
                    ->requiresConfirmation()
                    ->action(function (Domain $record) {
                        $record->due_at = $record->cycle_type->extendDuration($record->due_at);
                        $record->save();

                        Notification::make()
                            ->title('Domain duration extended')
                            ->success()
                            ->send();
                    }),
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
