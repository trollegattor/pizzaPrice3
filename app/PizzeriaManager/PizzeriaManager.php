<?php

namespace App\PizzeriaManager;

use App\Pizzerias\DominosPizzeria;
use Illuminate\Support\Manager;

class PizzeriaManager extends Manager
{
    public function getDefaultDriver()
    {
        $default = 'dominas';
        return $default;
    }
    public function createParsingPizzeriaDominosDriver()
    {
        return new DominosPizzeria();
    }


}
