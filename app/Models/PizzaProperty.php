<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PizzaProperty extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    public $fillable = [
        'cafe_id',
        'size',
        'flavor',
    ];

    /**
     * @return BelongsTo
     */
    public function cafe(): BelongsTo
    {
        return $this->belongsTo(Cafe::class);
    }

    /**
     * @return HasMany
     */
    public function price(): HasMany
    {
        return $this->hasMany(Price::class);
    }
}
