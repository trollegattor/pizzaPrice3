<?php

namespace App\Parsers\Cafes;

use App\Parsers\Cafes\Models\DishModel;
use App\Parsers\Cafes\Models\ProductModel;
use App\Parsers\Cafes\Models\ToppingModel;
use App\Parsers\Exceptions\ExceptionsJson\JsonCharException;
use App\Parsers\Exceptions\ExceptionsJson\JsonDepthException;
use App\Parsers\Exceptions\ExceptionsJson\JsonStateException;
use App\Parsers\Exceptions\ExceptionsJson\JsonSyntaxException;
use App\Parsers\Exceptions\ExceptionsJson\JsonUnknownException;
use App\Parsers\Exceptions\ExceptionsJson\JsonUtfException;
use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use Exception;
use Illuminate\Support\Str;
use stdClass;

class Dominos
{
    /**
     * @return ProductModel
     * @throws InvalidSelectorException
     */
    public function getPrices(): ProductModel
    {
        $dataJson = $this->getData();
        $productModel = $this->getDataBottom($dataJson);
        $toppingModel = $this->getToppings($dataJson);
        $dataProduct = new ProductModel(
            dishModel: $productModel,
            toppingModel: $toppingModel,
        );

        return $dataProduct;
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
     * @throws JsonCharException
     * @throws JsonDepthException
     * @throws JsonStateException
     * @throws JsonSyntaxException
     * @throws JsonUnknownException
     * @throws JsonUtfException
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
     * @throws JsonCharException
     * @throws JsonDepthException
     * @throws JsonStateException
     * @throws JsonSyntaxException
     * @throws JsonUnknownException
     * @throws JsonUtfException
     */
    protected function toJson($string): stdClass
    {
        $dataJson = json_decode($string);
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                break;
            case JSON_ERROR_DEPTH:
                throw new JsonDepthException('Достигнута максимальная глубина стека');
            case JSON_ERROR_STATE_MISMATCH:
                throw new JsonStateException('Некорректные разряды или несоответствие режимов');
            case JSON_ERROR_CTRL_CHAR:
                throw new JsonCharException('Некорректный управляющий символ');
            case JSON_ERROR_SYNTAX:
                throw new JsonSyntaxException('Синтаксическая ошибка, некорректный JSON');
            case JSON_ERROR_UTF8:
                throw new JsonUtfException('Некорректные символы UTF-8, возможно неверно закодирован');
            default:
                throw new JsonUnknownException('Неизвестная ошибка');
        }

        return $dataJson;
    }

    /**
     * @param $dataJson
     * @return array
     */
    protected function getDataBottom($dataJson): array
    {
        $dataPriceJson = [];
        foreach ($dataJson->data->groups as $groups) {
            foreach ($groups->products as $pizza) {
                $dataTopping = [];
                foreach ($pizza->toppings as $topping) {
                    $name = $topping->name;
                    $dataTopping[] = $name;
                }
                $consist = implode(', ', $dataTopping);
                $name = $pizza->name;
                $linkProduct = $pizza->link;
                foreach ($pizza->image as $key => $value) {
                    if ($key == '480')
                        $linkPicture = $value;
                }
                foreach ($pizza->sizes as $value) {
                    $size = $value->name;
                    foreach ($value->flavors as $everyPrice) {
                        $flavor = $everyPrice->name;
                        $price = $everyPrice->product->price;
                        $model = new DishModel(
                            cafe: config("cafes.dominos.data.name"),
                            name: $name,
                            size: $size,
                            flavor: $flavor,
                            price: $price,
                            link: $linkProduct,
                            picture: $linkPicture,
                            consist: $consist,
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
    protected function getToppings($dataJson): array
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
                $ingredient = new ToppingModel(
                    cafe: config("cafes.dominos.data.name"),
                    name: $name,
                    picture: $linkPicture,
                    price: '41'
                );
                $dataIngredient[] = $ingredient;
            }
        }
        return $dataIngredient;
    }
}
