<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Establishment extends Model
{
    use HasFactory;

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
    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class);
    }
}
