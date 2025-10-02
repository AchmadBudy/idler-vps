<?php

namespace App\Filament\Resources\Miscs\Pages;

use App\Filament\Resources\Miscs\MiscResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMisc extends ViewRecord
{
    protected static string $resource = MiscResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
