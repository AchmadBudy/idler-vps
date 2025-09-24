<?php

declare(strict_types=1);

namespace App\Filament\Resources\Servers\Pages;

use App\Filament\Resources\Servers\ServerResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateServer extends CreateRecord
{
    protected static string $resource = ServerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['price_per_month'] = $data['cycle_type']->getPricePerMonthly($data['price']);
        $data['price_per_year'] = $data['cycle_type']->getPricePerYearly($data['price']);
        $data['ip_addresses_v4'] ??= [];
        $data['ip_addresses_v6'] ??= [];

        return $data;
    }
}
