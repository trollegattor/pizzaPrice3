<?php

namespace App\Parsers;

use App\Parsers\Cafes\Dominos;
use Illuminate\Support\Manager;

class CafeManager extends Manager
{
    /**
     * @return string
     */
    public function getDefaultDriver()
    {
        $default = 'ParsingCafeDominos';
        return $default;
    }

    /**
     * @return Dominos
     */
    public function createParsingCafeDominosDriver()
    {
        return new Dominos();
    }


}
