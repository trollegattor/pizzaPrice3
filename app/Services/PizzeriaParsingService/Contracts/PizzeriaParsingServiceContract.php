<?php

namespace App\Services\PizzeriaParsingService\Contracts;

interface PizzeriaParsingServiceContract
{
    /**
     * @param string $pizzeria
     * @return array
     */
    public function getPizzeriaPrices(string $pizzeria): array;
}
