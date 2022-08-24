<?php

namespace App\PizzeriaManager;

use Illuminate\Support\Manager;

class PizzeriaManager extends Manager
{
    public function getDefaultDriver()
    {
        $default = 'dominas';
        return $default;
    }
    public function createParsingDominosUaPizzeriaDriver()
    {
        return new ParsingDominosUaPizzeriaD();
    }


}
