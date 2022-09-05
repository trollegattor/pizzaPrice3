<?php

namespace App\Orchid\Screens;

use App\Models\Pizza;
use App\Orchid\Layouts\ProductListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class Product extends Screen
{
    /**
     * @var string
     */
    public $message='Pizza';
    /**
     * @var string
     */
    public $description='Product Screen';
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        //dd(Pizza::all());
        return [
            'products'=>Pizza::all(),

        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->message;
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::columns([new ProductListLayout()])
        ];
    }

}
