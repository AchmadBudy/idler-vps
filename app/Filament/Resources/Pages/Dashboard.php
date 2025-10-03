<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

final class Dashboard extends BaseDashboard
{
    /**
     * @return int | array<string, ?int>
     */
    public function getColumns(): int|array
    {
        return 4;
    }
}
