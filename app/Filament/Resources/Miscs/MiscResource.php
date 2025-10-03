<?php

declare(strict_types=1);

namespace App\Filament\Resources\Miscs;

use App\Filament\Resources\Miscs\Pages\CreateMisc;
use App\Filament\Resources\Miscs\Pages\EditMisc;
use App\Filament\Resources\Miscs\Pages\ListMiscs;
use App\Filament\Resources\Miscs\Pages\ViewMisc;
use App\Filament\Resources\Miscs\Schemas\MiscForm;
use App\Filament\Resources\Miscs\Schemas\MiscInfolist;
use App\Filament\Resources\Miscs\Tables\MiscsTable;
use App\Models\Misc;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class MiscResource extends Resource
{
    protected static ?string $model = Misc::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return (string) self::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return MiscForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MiscInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MiscsTable::configure($table);
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
            'index' => ListMiscs::route('/'),
            'create' => CreateMisc::route('/create'),
            'view' => ViewMisc::route('/{record}'),
            'edit' => EditMisc::route('/{record}/edit'),
        ];
    }
}
