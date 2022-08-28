<?php

namespace App\Pizzerias;

class IngredientModel
{
    /**
     * @param string $groupName
     * @param string $name
     * @param string $lingPicture
     * @param string $price
     */
    public function __construct(
        public string $groupName,
        public string $name,
        public string $lingPicture,
        public string $price,
    )
    {
    }
}
