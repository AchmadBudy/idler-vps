<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $provider_id
 * @property string $name
 * @property string $owned_at
 * @property string $due_at
 * @property float $price
 * @property string $price_currency
 * @property string $cycle_type
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
    ];

    /**
     * Get the provider that owns the misc.
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
