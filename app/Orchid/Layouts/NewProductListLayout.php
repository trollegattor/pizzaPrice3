<?php

namespace App\Orchid\Layouts;


use App\Models\PizzaProperty;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NewProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Pizza')
                ->sort()
                ->width(20),

            TD::make('pizza_id', 'Size')
                ->sort()
                ->render(function ($product) {
                    return Select::make('idea.')
                        ->fromModel(PizzaProperty::class,'size')
                        ->title('Выберите свою идею');
                   // $size = $product->cafe->pizzaProperty->size;

                })



        ];
    }
}
