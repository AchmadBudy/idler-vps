<?php

declare(strict_types=1);

namespace App\Filament\Resources\Shareds;

use App\Filament\Resources\Shareds\Pages\CreateShared;
use App\Filament\Resources\Shareds\Pages\EditShared;
use App\Filament\Resources\Shareds\Pages\ListShareds;
use App\Filament\Resources\Shareds\Pages\ViewShared;
use App\Filament\Resources\Shareds\Schemas\SharedForm;
use App\Filament\Resources\Shareds\Schemas\SharedInfolist;
use App\Filament\Resources\Shareds\Tables\SharedsTable;
use App\Models\Shared;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class SharedResource extends Resource
{
    protected static ?string $model = Shared::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return (string) self::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return SharedForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SharedInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SharedsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShareds::route('/'),
            'create' => CreateShared::route('/create'),
            'view' => ViewShared::route('/{record}'),
            'edit' => EditShared::route('/{record}/edit'),
        ];
    }
}
