<?php

namespace App\Orchid\Layouts\Post;

use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'posts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title','title')
            ->render(function (Post $post){
                return Link::make($post->title)
                    ->route('platform.posts.edit',$post);
            }),
            TD::make('description','description')
                ->render(function (Post $post){
                    return $post->description;
                }),
        ];
    }
}
