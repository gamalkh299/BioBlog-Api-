<?php

namespace App\Orchid\Layouts\Post;

use App\Models\Category;
use App\Models\Tag;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class
PostRowLayout extends Rows
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
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function fields(): array
    {
        return [
            Group::make([
                Input::make('post.title')
                ->title('title')
                ->required(),

                Relation::make('post.categories')
                ->fromModel(Category::class,'name','id')
                ->title('Category')
                ->required()
                ->multiple(),

            ]),
            Quill::make('post.description')
            ->title('description')
            ->required(),

            Relation::make('post.tags')
            ->fromModel(Tag::class,'name','id')
            ->multiple()
            ->title('Tags'),

            Switcher::make('post.is_published')
                ->sendTrueOrFalse()
                ->value(false)
                ->title('Is Published'),

            Picture::make('post.attachment_id')
            ->title('Upload Image')
            ->targetUrl(),


        ];
    }
}
