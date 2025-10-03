<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Domain;
use App\Models\Misc;
use App\Models\Server;
use App\Models\Shared;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class TotalCost extends StatsOverviewWidget
{
    public function getColumns(): int|array
    {
        return 2;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Cost Per Month', $this->getTotalCost('month'))
                ->description('Total cost of all servers, shareds, domains, and miscs')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
            Stat::make('Total Cost Per Year', $this->getTotalCost('year'))
                ->description('Total cost of all servers, shareds, domains, and miscs')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }

    private function getTotalCost(string $period): string
    {
        $serverCost = Server::query()
            ->selectRaw("sum(price_per_{$period}) as total_cost, price_currency")
            ->groupBy('price_currency')
            ->get();

        $sharedCost = Shared::query()
            ->selectRaw("sum(price_per_{$period}) as total_cost, price_currency")
            ->groupBy('price_currency')
            ->get();

        $domainCost = Domain::query()
            ->selectRaw("sum(price_per_{$period}) as total_cost, price_currency")
            ->groupBy('price_currency')
            ->get();

        $miscCost = Misc::query()
            ->selectRaw("sum(price_per_{$period}) as total_cost, price_currency")
            ->groupBy('price_currency')
            ->get();

        $totalCost = $serverCost->toBase()
            ->merge($sharedCost->toBase())
            ->merge($domainCost->toBase())
            ->merge($miscCost->toBase())
            ->groupBy('price_currency')
            ->map(fn ($group) => number_format($group->sum('total_cost'), 2))
            ->map(fn ($cost, $currency) => $cost.' '.$currency)
            ->implode(', ');

        return $totalCost;
    }
}
