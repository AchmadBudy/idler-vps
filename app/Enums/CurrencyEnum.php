<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CurrencyEnum: string implements HasLabel
{
    case IDR = 'idr';
    case USD = 'usd';
    case EUR = 'eur';
    case GBP = 'gbp';
    case CNY = 'cny';

    public function getLabel(): string
    {
        return match ($this) {
            self::IDR => 'IDR - Rupiah',
            self::USD => 'USD - US Dollar',
            self::EUR => 'EUR - Euro',
            self::GBP => 'GBP - British Pound',
            self::CNY => 'CNY - Yuan Renminbi',
        };
    }

    public function getSymbol(): string
    {
        return match ($this) {
            self::IDR => 'Rp',
            self::USD => '$',
            self::EUR => '€',
            self::GBP => '£',
            self::CNY => '¥',
        };
    }

    public function getDecimal(): int
    {
        return match ($this) {
            self::IDR => 2,
            self::USD => 2,
            self::EUR => 2,
            self::GBP => 2,
            self::CNY => 2,
        };
    }
}
