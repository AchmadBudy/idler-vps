<?php

declare(strict_types=1);

namespace App\Filament\Resources\Miscs\Tables;

use App\Models\Misc;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class MiscsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
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
                Action::make('Extend Duration')
                    ->icon('heroicon-o-clock')
                    ->requiresConfirmation()
                    ->action(function (Misc $record) {
                        $record->due_at = $record->cycle_type->extendDuration($record->due_at);
                        $record->save();

                        Notification::make()
                            ->title('Misc duration extended')
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
