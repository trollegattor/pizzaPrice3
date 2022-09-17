<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cafe extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @var string[]
     */
    public $fillable = [
        'name',
        'address',
        'phone',
    ];

    /**
     * @return HasMany
     */
    public function pizza(): HasMany
    {
        return $this->hasMany(Pizza::class);
    }

    /**
     * @return HasMany
     */
    public function pizzaProperty(): HasMany
    {
        return $this->hasMany(PizzaProperty::class);
    }


    /**
     * @return HasMany
     */
    public function topping(): HasMany
    {
        return $this->hasMany(Topping::class);
    }
}
