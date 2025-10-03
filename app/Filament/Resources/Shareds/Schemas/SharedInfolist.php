<?php

declare(strict_types=1);

namespace App\Filament\Resources\Shareds\Schemas;

use Filament\Schemas\Schema;

final class SharedInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}
