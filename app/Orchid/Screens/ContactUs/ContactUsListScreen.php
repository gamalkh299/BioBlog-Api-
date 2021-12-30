<?php

namespace App\Orchid\Screens\ContactUs;

use App\Models\ContactUs;
use App\Orchid\Layouts\ContactUs\ContactUsListLayout;
use Orchid\Screen\Screen;

class ContactUsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Messages List';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'messages'=>ContactUs::filters()->defaultSort('id', 'desc')->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [

            ContactUsListLayout::class,
        ];
    }
}
