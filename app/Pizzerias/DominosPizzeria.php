<?php

namespace App\Pizzerias;

use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use Illuminate\Support\Str;
use stdClass;

class DominosPizzeria
{
    /**
     * @return array
     * @throws InvalidSelectorException
     */
    public function getPrices(): array
    {
        $dataJson = $this->getData();
        $dataPrice = $this->getDataPrice($dataJson);

        return $dataPrice;
    }

    /**
     * @return stdClass
     * @throws InvalidSelectorException
     */
    protected function getData(): stdClass
    {
        $website = new Document('https://dominos.ua/uk/odessa/Pizza/', true);
        $htmlScripts = $website->find('script');
        $dataUncode = $htmlScripts[8]->html();
        $data = $this->decodeData($dataUncode);

        return $data;
    }

    /**
     * @param $pizzeriaData
     * @return stdClass
     */
    protected function decodeData($data): stdClass
    {
        $unicode = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $data);
        $language = preg_replace_callback("/(&#[0-9]+;)/", function ($match) {
            return mb_convert_encoding($match[1], "UTF-8", "HTML-ENTITIES");
        }, $unicode);
        $dataStr = Str::between($language, "JSON.parse('", "');");
        $dataJson = $this->toJson($dataStr);

        return $dataJson;
    }

    /**
     * @param $string
     * @return stdClass
     */
    protected function toJson($string): stdClass
    {
        $dataJson = json_decode($string);
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                //echo ' - Ошибок нет';
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
        // echo PHP_EOL;

        return $dataJson;
    }

    /**
     * @param $dataJson
     * @return array
     */
    protected function getDataPrice($dataJson)
    {
        $dataPriceJson = [];
        foreach ($dataJson->data->groups as $groups) {
            foreach ($groups->products as $pizza) {
                $name = $pizza->name;
                foreach ($pizza->sizes as $value) {
                    $size = $value->name;
                    foreach ($value->flavors as $everyPrice) {
                        $flavor = $everyPrice->name;
                        $weight = $everyPrice->product->weight;
                        $price = $everyPrice->product->price;
                        $array = array('name', 'size', 'flavor', 'weight', 'price');
                        $dataPrice = compact($array);
                        $dataPriceJson[] = $dataPrice;
                    }
                }
            }
        }
        return $dataPriceJson;
    }
}
