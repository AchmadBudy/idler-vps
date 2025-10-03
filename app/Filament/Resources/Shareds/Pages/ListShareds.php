<?php

declare(strict_types=1);

namespace App\Filament\Resources\Shareds\Pages;

use App\Filament\Resources\Shareds\SharedResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListShareds extends ListRecords
{
    protected static string $resource = SharedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
