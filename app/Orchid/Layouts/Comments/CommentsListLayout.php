<?php

namespace App\Orchid\Layouts\Comments;

use App\Models\Comment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CommentsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'Comments';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('comment','Comment')
            ->filter('comment')
            ->sort('comment')
            ->render(function (Comment $comment){
                     return $comment->comment;
            }),
            TD::make('Post')
            ->render(function (Comment $comment){
                return Link::make($comment->post->title)
                    ->route('platform.posts.edit',$comment->post->id);
            }),

            TD::make('created_at','Created At')
            ->sort()
            ->filter('created_at')->render(function (Comment $comment){
                return $comment->created_at->diffForHumans();
                }),

            TD::make('Delete')
            ->render(function (Comment $comment){
                return Button::make('Delete')
                    ->icon('trash')
                    ->method('delete')
                    ->parameters([$comment->id])
                    ->confirm('Are you sure you want to delete this comment');
            })

        ];
    }
}
