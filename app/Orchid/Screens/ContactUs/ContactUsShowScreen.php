<?php

namespace App\Orchid\Screens\ContactUs;

use App\Models\ContactUs;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ContactUsShowScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Show Message';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(ContactUs $contactUs): array
    {
        return [
            'message'=>$contactUs
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
            Button::make('Delete')
                ->method('delete')
                ->icon('trash')
                ->confirm('Are you Sure you want to delete this Message ?')

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
            Layout::legend('message', [

                Sight::make('name')
                    ->render(function (ContactUs $contactUs){
                        return $contactUs->name;
                    }),
                Sight::make('Email')
                    ->render(function (ContactUs $contactUs){
                        return $contactUs->email;
                    }),
                Sight::make('Phone')
                    ->render(function (ContactUs $contactUs){
                        return $contactUs->phone;
                    }),
                Sight::make('Message')
                    ->render(function (ContactUs $contactUs){
                        return $contactUs->message;
                    }),

            ]),
        ];
    }

    public function delete(ContactUs $contactUs)
    {
        $contactUs->delete();
        Toast::success('Message Deleted Successfully');
        return redirect()->route('platform.contacts');
    }
}
