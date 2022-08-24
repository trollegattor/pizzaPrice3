<?php

namespace App\Services\PizzeriaParsingService;

use App\Services\PizzeriaParsingService\Contracts\PizzeriaParsingServiceContract;
use DiDom\Document;
use DiDom\Query;

use Illuminate\Support\Str;
class PizzeriaParsingService implements PizzeriaParsingServiceContract
{
    /**
     * @param string $pizzeria
     * @return string[]
     */
    public function getPizzeriaPrices(string $pizzeria): array
    {
        $model=new Document('https://dominos.ua/uk/odessa/Pizza/',true,'utf-8');
        $find=$model->find('script', Query::TYPE_CSS);
        foreach ($find as $element)
        {
           if (str_contains($element->html(),'window.app_props = JSON.parse'))
             $strPizza=$element;
        }
        $output = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $strPizza->html());
        $sliceAfter=Str::after($output,"JSON.parse('");
        $sliceBefore=Str::beforeLast($sliceAfter,"]}');");
        $json = \OviDigital\JsObjectToJson\JsConverter::convertToJson($sliceBefore);

        dd($json);



        $file=storage_path('app/study2.php');
        $a=file_get_contents($file);
//        dd($a);



        return ['Pizzeria'=>$pizzeria];
    }
}
