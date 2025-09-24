<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CycleTypeEnum: string implements HasLabel
{
    case MONTHLY = 'monthly';
    case THREE_MONTHLY = 'three_monthly';
    case SIX_MONTHLY = 'six_monthly';
    case YEARLY = 'yearly';
    case TWO_YEARLY = 'two_yearly';
    case THREE_YEARLY = 'three_yearly';

    public function getLabel(): string
    {
        return match ($this) {
            self::MONTHLY => 'Monthly',
            self::THREE_MONTHLY => 'Three Monthly',
            self::SIX_MONTHLY => 'Six Monthly',
            self::YEARLY => 'Yearly',
            self::TWO_YEARLY => 'Two Yearly',
            self::THREE_YEARLY => 'Three Yearly',
        };
    }

    public function getPricePerMonthly($price): float
    {
        return round(match ($this) {
            self::MONTHLY => $price,
            self::THREE_MONTHLY => $price / 3,
            self::SIX_MONTHLY => $price / 6,
            self::YEARLY => $price / 12,
        }, 1);
    }

    public function getPricePerYearly($price): float
    {
        return round(match ($this) {
            self::MONTHLY => $price * 12,
            self::THREE_MONTHLY => $price * 12 / 3,
            self::SIX_MONTHLY => $price * 12 / 6,
            self::YEARLY => $price,
        }, 1);
    }
}
