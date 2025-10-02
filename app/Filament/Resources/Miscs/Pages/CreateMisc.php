<?php

declare(strict_types=1);

namespace App\Filament\Resources\Miscs\Pages;

use App\Filament\Resources\Miscs\MiscResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateMisc extends CreateRecord
{
    protected static string $resource = MiscResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['price_per_month'] = $data['cycle_type']->getPricePerMonthly($data['price']);
        $data['price_per_year'] = $data['cycle_type']->getPricePerYearly($data['price']);

        return $data;
    }
}
