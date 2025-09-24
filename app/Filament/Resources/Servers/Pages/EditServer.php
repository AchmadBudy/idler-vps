<?php

declare(strict_types=1);

namespace App\Filament\Resources\Servers\Pages;

use App\Filament\Resources\Servers\ServerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditServer extends EditRecord
{
    protected static string $resource = ServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['price_per_month'] = $data['cycle_type']->getPricePerMonthly($data['price']);
        $data['price_per_year'] = $data['cycle_type']->getPricePerYearly($data['price']);
        $data['ip_addresses_v4'] ??= [];
        $data['ip_addresses_v6'] ??= [];

        return $data;
    }
}
