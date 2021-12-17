<?php

namespace App\Orchid\Layouts\Post;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;

class PostRowLayout extends Rows
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
            Input::make('post.title')
            ->title('title')
            ->required(),
            Quill::make('post.description')
            ->title('description')
            ->required(),
            Switcher::make('post.is_published')
                ->sendTrueOrFalse()
                ->title('Is Published'),
        ];
    }
}
