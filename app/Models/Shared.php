<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CurrencyEnum;
use App\Enums\CycleTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $name
 * @property string $domain
 * @property string $panel_type
 * @property string $ipv4
 * @property string|null $ipv6
 * @property string $location
 * @property \Illuminate\Support\Carbon $owned_at
 * @property \Illuminate\Support\Carbon $due_at
 * @property float $price
 * @property CurrencyEnum $price_currency
 * @property CycleTypeEnum $cycle_type
 * @property float $price_per_month
 * @property float $price_per_year
 * @property int $domains
 * @property int $subdomains
 * @property int $disk_in_gb
 * @property int $emails
 * @property int $bandwith_in_gb
 * @property int $ftp
 * @property int $databases
 * @property bool $is_reseller
 * @property int|null $accounts
 * @property int $provider_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read Provider $provider
 */
final class Shared extends Model
{
    use HasUuids;

    /**
     * Get the provider that owns this shared hosting.
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
            'price' => 'float',
            'price_per_month' => 'float',
            'price_per_year' => 'float',
            'owned_at' => 'date',
            'due_at' => 'date',
            'price_currency' => CurrencyEnum::class,
            'cycle_type' => CycleTypeEnum::class,
            'is_reseller' => 'boolean',
            'accounts' => 'integer',
        ];
    }
}
