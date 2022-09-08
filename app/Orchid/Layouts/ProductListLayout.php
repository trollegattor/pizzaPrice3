<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'prices';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('pizza_id', 'Cafe')
                ->sort()
                ->width(20)
                ->render(function ($prices) {
                    $cafe = $prices->pizza->cafe->name;

                    return $cafe;
                }),
            TD::make('pizza_id', 'Pizza')
                ->sort()
                ->render(function ($prices) {
                    $link = $prices->pizza->name;

                    return $link;
                })
                ->width(80),
            TD::make('price', 'Price')
                ->sort()
                ->width(20),
            TD::make('pizza_id', 'Picture')
                ->width(5)
                ->render(function ($prices) {
                    $picture = $prices->pizza->picture;

                    return view('picture',['link'=>$picture]);
                }),
            TD::make('pizza_id', 'Size')
                ->width(80)
                ->render(function ($prices) {
                    $size = $prices->pizzaProperty->size;

                    return $size;
                }),
            TD::make('pizza_id', 'Flavor')
                ->width(80)
                ->render(function ($prices) {
                    $flavor = $prices->pizzaProperty->flavor;

                    return $flavor;
                }),
            TD::make('pizza_id', 'Consist')
                ->width(120)
                ->render(function ($prices) {
                    $consist = $prices->pizza->consist;

                    return $consist;
                }),
            TD::make('pizza_id', 'Pizza')
                ->width(10)
                ->render(function ($prices) {
                    $link = Link::make('Link')
                        ->href($prices->pizza->link);

                    return $link;
                })
        ];
    }
}
