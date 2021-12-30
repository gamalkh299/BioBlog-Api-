<?php

namespace App\Orchid\Layouts\ContactUs;

use App\Models\ContactUs;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ContactUsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'messages';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('Name')
            ->filter('name')
            ->sort()
            ->render(function (ContactUs $contactUs){
                return Link::make($contactUs->name)
                    ->route('platform.contact.show',$contactUs->id)
                    ->icon('pencil');

            }),

            TD::make('Email')
            ->filter('email')
            ->sort()
            ->render(function (ContactUs $contactUs){
                return $contactUs->email;
            }),

            TD::make('Phone')
            ->filter('phone')
                ->sort()
                ->render(function (ContactUs $contactUs){
                    return $contactUs->phone;
                }),
            TD::make('Message')
                ->filter('phone')
                ->sort()
                ->render(function (ContactUs $contactUs){
                    return substr($contactUs->message,'0','30').'...';
                }),

        ];
    }
}
