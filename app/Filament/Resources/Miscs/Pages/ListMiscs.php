<?php

declare(strict_types=1);

namespace App\Filament\Resources\Miscs\Pages;

use App\Filament\Resources\Miscs\MiscResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListMiscs extends ListRecords
{
    protected static string $resource = MiscResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
