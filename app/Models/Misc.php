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
 * @property string $provider_id
 * @property string $name
 * @property \Illuminate\Support\Carbon $owned_at
 * @property \Illuminate\Support\Carbon $due_at
 * @property float $price
 * @property CurrencyEnum $price_currency
 * @property CycleTypeEnum $cycle_type
 * @property float $price_per_month
 * @property float $price_per_year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
final class Misc extends Model
{
    use HasUuids;

    protected $casts = [
        'owned_at' => 'date',
        'due_at' => 'date',
        'price' => 'float',
        'price_per_month' => 'float',
        'price_per_year' => 'float',
        'cycle_type' => CycleTypeEnum::class,
        'price_currency' => CurrencyEnum::class,
    ];

    /**
     * Get the provider that owns the misc.
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
