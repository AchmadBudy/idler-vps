<?php

namespace App\Filament\Resources\Shareds\Pages;

use App\Filament\Resources\Shareds\SharedResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewShared extends ViewRecord
{
    protected static string $resource = SharedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
