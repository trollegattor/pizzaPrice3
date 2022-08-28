<?php

namespace App\Pizzerias;

class ProductModel
{
    /**
     * @param array $pizzaModel
     * @param array $ingredientModel
     */
    public function __construct(
        public array $pizzaModel,
        public array $ingredientModel,
    )
    {
    }
}
