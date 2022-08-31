<?php

namespace App\Creators\Models;

use App\Models\Cafe;
use App\Models\Topping;

class SaveToppingModel
{
    /**
     * @param $data
     * @return void
     */
    public function saveData($data)
    {
        foreach ($data as $element)
        {
           $this->saveTopping($element);
        }
    }

    /**
     * @param $data
     * @return void
     */
    protected function saveTopping($data)
    {
        Topping::query()->updateOrCreate(
            [
                'cafe_id' => Cafe::query()->where('name', $data->cafe)->first()->id,
                'name' => $data->name
            ],
            [
                'picture'=>$data->picture,
                'price'=>$data->price,
            ]
        );
    }
}
