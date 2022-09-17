<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class Price extends Model
{
    use AsSource;
    use HasFactory;

    /** @var bool */
    public $timestamps = false;

    /** @var string[] */
    public $fillable = [
        'pizza_id',
        'pizza_property_id',
        'price',
    ];

    /**
     * @return BelongsTo
     */
    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }

    /**
     * @return BelongsTo
     */
    public function pizzaProperty(): BelongsTo
    {
        return $this->belongsTo(PizzaProperty::class);
    }
}
