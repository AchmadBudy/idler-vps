<?php

declare(strict_types=1);

namespace App\Filament\Resources\Servers\Tables;

use App\Models\Server;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ServersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Server Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('provider.name')
                    ->label('Provider')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('server_type')
                    ->label('Server Type')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_owned')
                    ->label('Is Owned')
                    ->boolean(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money(fn (Server $record): string => $record->price_currency->value)
                    ->sortable(),
                TextColumn::make('cycle_type')
                    ->label('Billing Cycle')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('owned_at')
                    ->label('Owned At')
                    ->date('j M  Y'),
                TextColumn::make('due_at')
                    ->label('Due At')
                    ->date('j M  Y'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('Extend Duration')
                    ->icon('heroicon-o-clock')
                    ->requiresConfirmation()
                    ->action(function (Server $record) {
                        $record->due_at = $record->cycle_type->extendDuration($record->due_at);
                        $record->save();

                        Notification::make()
                            ->title('Server duration extended')
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
