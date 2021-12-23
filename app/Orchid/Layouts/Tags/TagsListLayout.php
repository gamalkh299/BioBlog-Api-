<?php

namespace App\Orchid\Layouts\Tags;

use App\Models\Tag;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TagsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'tags';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name','Tag')
            ->filter('name')
            ->sort()
            ->render(function (Tag $tag){
                return ModalToggle::make($tag->name)
                    ->modal('tag')
                    ->modalTitle('Edit Tag')
                    ->asyncParameters(['tag'=>$tag])
                    ->method('CreateOrUpdate');
            }),

            TD::make('Count Of Related Posts')
                ->render(function (Tag $tag){
                    return $tag->posts()->count();
                }),

            TD::make('Delete')
            ->render(function (Tag $tag){
                return Button::make('Delete')
                    ->method('delete')
                    ->icon('trash')
                    ->parameters(['tag'=>$tag->id]);
            })




        ];
    }
}
