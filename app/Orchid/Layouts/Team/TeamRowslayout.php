<?php

namespace App\Orchid\Layouts\Team;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Rows;

class TeamRowslayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('team.name')
                ->required()
                ->title('name')
                ->type('text'),
            Input::make('team.job')
                ->required()
                ->title('job')
                ->type('text'),

            Input::make('team.whatsapp')
                ->title('WhatsApp')
                ->type('phone'),

            Input::make('team.twitter')
                ->title('twitter')
                ->type('text'),

            Input::make('team.facebook')
                ->title('facebook')
                ->type('text'),

            Picture::make('team.attachment_id')
            ->title('image')
            ->required()
            ->targetId(),



        ];
    }
}
