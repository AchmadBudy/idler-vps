<?php

declare(strict_types=1);

namespace App\Filament\Resources\Miscs\Pages;

use App\Filament\Resources\Miscs\MiscResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditMisc extends EditRecord
{
    protected static string $resource = MiscResource::class;

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

        return $data;
    }
}
