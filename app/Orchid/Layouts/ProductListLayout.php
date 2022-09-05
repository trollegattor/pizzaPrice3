<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Upload;
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
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name','Product')
                ->align('left')
                ->width('200px'),
            TD::make('picture','Picture')
                ->align('left')
                ->width('10px')
                ->render(function ($product){
                    return Picture::make('product')
                        ->value($product->picture);
                }),
            TD::make('link','Link')
                ->render(function ($product){
                    return Link::make('Pizza it!')
                        ->href($product->link);
                }),


        ];
    }
}
