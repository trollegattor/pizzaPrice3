<?php

namespace App\Creators\Models;

use App\Models\Cafe;
use App\Models\Pizza;
use App\Models\PizzaProperty;
use App\Models\Price;

class SaveDishModel
{
    /**
     * @param $data
     * @return void
     */
    public function saveData($data)
    {
        foreach ($data as $element) {
            $this->saveCafe($element);
            $this->savePizza($element);
            $this->savePizzaProperty($element);
            $this->savePrice($element);
        }
    }

    /**
     * @param $data
     * @return void
     */
    protected function saveCafe($data)
    {
        $cafeData = config('cafes.' . $data->cafe . '.data');
        Cafe::query()->updateOrCreate(['name' => $data->cafe], $cafeData);
    }

    /**
     * @param $data
     * @return void
     */
    protected function savePizza($data)
    {
        Pizza::query()->updateOrCreate(
            [
                'cafe_id' => Cafe::query()->where('name', $data->cafe)->first()->id,
                'name' => $data->name
            ],
            [
                'link' => $data->link,
                'picture' => $data->picture,
                'consist' => $data->consist,
            ]
        );
    }

    /**
     * @param $data
     * @return void
     */
    protected function savePizzaProperty($data)
    {
        PizzaProperty::query()->updateOrCreate(
            [
                'cafe_id' => Cafe::query()->where('name', $data->cafe)->first()->id,
                'size' => $data->size,
                'flavor' => $data->flavor
            ],
        );
    }

    /**
     * @param $data
     * @return void
     */
    protected function savePrice($data)
    {
        Price::query()->updateOrCreate(
            [
                'pizza_id' => Pizza::query()->where('name', $data->name)->first()->id,
                'pizza_property_id' => PizzaProperty::query()->
                where('size', $data->size,)->
                where('flavor', $data->flavor)->
                first()->id,
                'price' => $data->price
            ],
            [
                'price' => $data->price
            ],
        );
    }
}
