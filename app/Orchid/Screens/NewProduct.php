<?php

namespace App\Orchid\Screens;

use App\Models\Pizza;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class NewProduct extends Screen
{
    /**
     * @var string
     */
    public $message = 'Products';
    /**
     * @var string
     */
    public $description = 'Products from cafes in Odessa';

    /**
     * Query data.
     *
     * @return array
     */
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Pizza::all(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'NewProduct';
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
            Layout::view('size')
        ];
    }
}
