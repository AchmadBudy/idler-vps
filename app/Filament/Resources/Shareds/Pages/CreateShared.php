<?php

declare(strict_types=1);

namespace App\Filament\Resources\Shareds\Pages;

use App\Filament\Resources\Shareds\SharedResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateShared extends CreateRecord
{
    protected static string $resource = SharedResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['price_per_month'] = $data['cycle_type']->getPricePerMonthly($data['price']);
        $data['price_per_year'] = $data['cycle_type']->getPricePerYearly($data['price']);
        if (! $data['is_reseller']) {
            $data['accounts'] = null;
        }

        return $data;
    }
}
