<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CurrencyEnum;
use App\Enums\CycleTypeEnum;
use App\Enums\DataUnitEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $name
 * @property string $hostname
 * @property int $provider_id
 * @property array $ip_addresses_v4
 * @property array $ip_addresses_v6
 * @property string $server_type
 * @property string $os
 * @property int $cpu
 * @property string $cpu_model
 * @property int $ram
 * @property DataUnitEnum $ram_type
 * @property int $disk
 * @property DataUnitEnum $disk_type
 * @property string $location
 * @property \Illuminate\Support\Carbon $owned_at
 * @property \Illuminate\Support\Carbon $due_at
 * @property float $price
 * @property CurrencyEnum $price_currency
 * @property CycleTypeEnum $cycle_type
 * @property float $price_per_month
 * @property float $price_per_year
 * @property bool $is_owned
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
final class Server extends Model
{
    use HasUuids;

    /**
     * Get the provider that owns the server.
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'ip_addresses_v4' => 'array',
            'ip_addresses_v6' => 'array',
            'cycle_type' => CycleTypeEnum::class,
            'price' => 'float',
            'price_per_month' => 'float',
            'price_per_year' => 'float',
            'owned_at' => 'date',
            'due_at' => 'date',
            'price_currency' => CurrencyEnum::class,
            'ram_type' => DataUnitEnum::class,
            'disk_type' => DataUnitEnum::class,
            'is_owned' => 'boolean',
        ];
    }
}
