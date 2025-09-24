<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DataUnitEnum: string implements HasLabel
{
    case TB = 'TB';
    case GB = 'GB';
    case MB = 'MB';

    public function getLabel(): string
    {
        return match ($this) {
            self::TB => 'TB',
            self::GB => 'GB',
            self::MB => 'MB',
        };
    }
}
