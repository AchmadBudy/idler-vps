<?php

declare(strict_types=1);

namespace App\Filament\Resources\Domains\Schemas;

use Filament\Schemas\Schema;

final class DomainInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}
