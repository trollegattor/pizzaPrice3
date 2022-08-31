<?php

namespace App\Parsers\Cafes\Models;

class ToppingModel
{
    /**
     * @param string $groupName
     * @param string $name
     * @param string $lingPicture
     * @param string $price
     */
    public function __construct(
        public string $cafe,
        public string $name,
        public string $picture,
        public string $price,
    )
    {
    }
}
