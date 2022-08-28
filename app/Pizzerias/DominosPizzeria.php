<?php

namespace App\Pizzerias;

use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use Exception;
use Illuminate\Support\Str;
use stdClass;

class DominosPizzeria
{
    /**
     * @return ProductModel
     * @throws InvalidSelectorException
     */
    public function getPrices(): ProductModel
    {
        $dataJson = $this->getData();
        $dataPizzas = $this->getDataPizzas($dataJson);
        $dataIngredients=$this->getIngredients($dataJson);
        $dataProducts=new ProductModel($dataPizzas,$dataIngredients);

        return $dataProducts;
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
     * @param $data
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
    protected function getDataPizzas($dataJson)
    {
        $dataPriceJson = [];
        foreach ($dataJson->data->groups as $groups) {
            foreach ($groups->products as $pizza) {
                $dataTopping = [];
                foreach ($pizza->toppings as $topping) {
                    $name = $topping->group_name;
                    $max_quantity = $topping->max_quantity;
                    $dataTopping[] = array('group_name' => $name, 'max_quantity' => $max_quantity);
                }
                $name = $pizza->name;
                $linkProduct = $pizza->link;
                $linkPicture = $pizza->image->full;
                foreach ($pizza->sizes as $value) {
                    $size = $value->name;
                    foreach ($value->flavors as $everyPrice) {
                        $flavor = $everyPrice->name;
                        $weight = $everyPrice->product->weight;
                        $price = $everyPrice->product->price;
                        $model = new PizzaModel(
                            name: $name,
                            size: $size,
                            flavor: $flavor,
                            weight: $weight,
                            price: $price,
                            linkProduct: $linkProduct,
                            linkPicture: $linkPicture,
                            dataTopping: $dataTopping,
                        );
                        $dataPriceJson[] = $model;
                    }
                }
            }
        }
        return $dataPriceJson;
    }

    /**
     * @param $dataJson
     * @return array
     */
    protected function getIngredients($dataJson)
    {
        $dataIngredient = [];
        foreach ($dataJson->data->filters as $item) {
            foreach ($item->toppings as $element) {
                try {
                    $linkPicture = $element->image->full;
                } catch (Exception) {
                    continue;
                }
                $name = $element->name;
                $ingredient = new IngredientModel(
                    groupName: $item->name,
                    name: $name,
                    lingPicture: $linkPicture,
                    price: '41'
                );
                $dataIngredient[] = $ingredient;
            }
        }
        return $dataIngredient;
    }
}
