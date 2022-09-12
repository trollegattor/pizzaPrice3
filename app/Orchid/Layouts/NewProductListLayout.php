<?php

namespace App\Orchid\Layouts;


use App\Models\PizzaProperty;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NewProductListLayout extends Table
{
    protected $a;
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
                ->width(100)
            ->render(function ($product){

                return view('nameLink',['product'=>$product]);
            }),

            TD::make('size', 'Size')
                ->sort()
                ->render(function ($product) {
                    $size=[];
                    $sizeCollection=PizzaProperty::where('cafe_id', $product->cafe_id)->distinct()->get('size');
                    foreach ($sizeCollection as $item) {
                        $size[]=$item->size;
                    }
                    return Select::make('size')
                        ->options($size)
                        ->title('Выберите свой рзмер');
                }),
            TD::make('size', 'Size')
                ->sort()
                ->render(function ($product) {
                    $size=[];
                    $sizeCollection=PizzaProperty::where('cafe_id', $product->cafe_id)->distinct()->get('size');
                    foreach ($sizeCollection as $item) {
                        $size[]=$item->size;
                    }
                    $select=Select::make('size')
                        ->options($size)
                        ->title('Выберите свой рзмер');
                    return view('size',['select'=>$select]);
                }),

           TD::make('pizza_id', 'fg')
                ->sort()
                ->render(function () {
                    return \request()->size;
                })




        ];
    }
    public function send()
    {
        dd($this->a);
    }
}
