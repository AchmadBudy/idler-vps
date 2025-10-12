<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

final class Dashboard extends BaseDashboard
{
    public function getColumns(): int
    {
        return 4;
    }
}
