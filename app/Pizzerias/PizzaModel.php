<?php

namespace App\Pizzerias;

use phpDocumentor\Reflection\Types\Integer;

class PizzaModel
{
    /**
     * @param string $name
     * @param string $size
     * @param string $flavor
     * @param int $weight
     * @param string $price
     * @param string $linkProduct
     * @param string $linkPicture
     * @param array $dataTopping
     */
    public function __construct(
        public string $name,
        public string $size,
        public string $flavor,
        public string $weight,
        public string $price,
        public string $linkProduct,
        public string $linkPicture,
        public array  $dataTopping,
    )
    {
    }
}
