<?php

namespace App\Parsers\Cafes\Models;

class DishModel
{
    /**
     * @param string $cafe
     * @param string $name
     * @param string $size
     * @param string $flavor
     * @param string $price
     * @param string $link
     * @param string $picture
     * @param string $consist
     */
    public function __construct(
        public string $cafe,
        public string $name,
        public string $size,
        public string $flavor,
        public string $price,
        public string $link,
        public string $picture,
        public string $consist,
    )
    {
    }
}
