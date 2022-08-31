<?php

namespace App\Parsers\Cafes\Models;

class ProductModel
{
    /**
     * @param array $dishModel
     * @param array $toppingModel
     */
    public function __construct(
        public array $dishModel,
        public array $toppingModel,
    )
    {
    }
}
