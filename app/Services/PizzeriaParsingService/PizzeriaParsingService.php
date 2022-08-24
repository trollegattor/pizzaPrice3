<?php

namespace App\Services\PizzeriaParsingService;

use App\Services\PizzeriaParsingService\Contracts\PizzeriaParsingServiceContract;
use DiDom\Document;
use DiDom\Query;

use Illuminate\Support\Str;
use OviDigital\JsObjectToJson\JsConverter;

class PizzeriaParsingService implements PizzeriaParsingServiceContract
{
    /**
     * @param string $pizzeria
     * @return string[]
     */
    public function getPizzeriaPrices(string $pizzeria): array
    {
        $model=new Document('https://dominos.ua/uk/odessa/Pizza/',true,'utf-8');
        $htmlScripts=$model->find('script', Query::TYPE_CSS);
        foreach ($htmlScripts as $element)
        {
           if (str_contains($element->html(),'window.app_props = JSON.parse'))
             $htmlScript=$element;
        }

        $Unicod= preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $htmlScript->html());;
        //dd($fjj);
        //$file=storage_path('app/study3.php');
        //$a=file_get_contents($file);
        $htmlScript2 = Str::replace(';:',';-', $Unicod);
        $convertedHtmlScript = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $htmlScript2);
        $slicedHtmlScript=Str::between($convertedHtmlScript,"JSON.parse('","');");
        $correctHttp = Str::replace('https://','https://', $slicedHtmlScript);
        $correct1 = Str::replace(['[]'],'Nan', $correctHttp);

        $correct2 = Str::remove(['\u0022','true'],$correct1);
        $correctSimbol=Str::remove(['#'],$correct2);
        $correct3 = Str::replace('[https//media.dominos.ua/icon/svg_file/2018/02/23/new.svg]','"{https//media.dominos.ua/icon/svg_file/2018/02/23/new.svg}"', $correctSimbol);


        $json1 = JsConverter::convertToJson($correct3);
        $array=JsConverter::convertToArray($correctSimbol);
        //dd($array);
        $b=json_decode($json1,true);

        $json[] = $json1;


        foreach ($json as $string) {
            echo 'Декодируем: ' . $string;
            json_decode($string);

            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    echo ' - Ошибок нет';
                    break;
                case JSON_ERROR_DEPTH:
                    echo ' - Достигнута максимальная глубина стека';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo ' - Некорректные разряды или несоответствие режимов';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    echo ' - Некорректный управляющий символ';
                    break;
                case JSON_ERROR_SYNTAX:
                    echo ' - Синтаксическая ошибка, некорректный JSON';
                    break;
                case JSON_ERROR_UTF8:
                    echo ' - Некорректные символы UTF-8, возможно неверно закодирован';
                    break;
                default:
                    echo ' - Неизвестная ошибка';
                    break;
            }

            echo PHP_EOL;
        }






        //dd($json);

        //dd($json);



        $file=storage_path('app/study2.php');
        $a=file_get_contents($file);
//        dd($a);



        return ['Pizzeria'=>$pizzeria];
    }
}
