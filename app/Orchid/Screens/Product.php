<?php

namespace App\Orchid\Screens;

use App\Http\Controllers\PriceController;
use App\Models\Pizza;
use App\Models\Price;
use App\Orchid\Layouts\ProductListLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Orchid\Alert\Toast;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class Product extends Screen
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
    public function query(): iterable
    {
        return [
            'products' => Pizza::all(),
            'prices' => Price::all(),

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
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Refresh products')
                ->icon('database')
                ->method('update'),
        ];
    }

    /**
     * Views.
     *
     * @return iterable
     */
    public function layout(): iterable
    {
        return [
            ProductListLayout::class
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function update()
    {
        return redirect()->action([PriceController::class, 'parsePrices']);
    }


}
