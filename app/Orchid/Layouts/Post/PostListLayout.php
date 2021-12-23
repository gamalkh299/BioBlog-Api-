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
            ->sort()
            ->filter('title')
            ->render(function (Post $post){
                return Link::make($post->title)
                    ->route('platform.posts.edit',$post->id);
            }),
            TD::make('description','description')
            ->sort()
            ->filter('description')
            ->render(function (Post $post){
                return substr($post->description,0,80).'..';
            }),
            TD::make('is_published', 'Published')
            ->sort()
            ->filter('is_published')
            ->render(function (Post $post){
               return view('admin.active',['active'=>$post->is_published]);
            }),
            TD::make('Category', 'Category')
                ->render(function (Post $post){
                    if ($post->categories()->count()>0){
                        $cats='';
                        foreach ($post->categories as $category){
                            $cats.= $category->name . " - ";
                        }
                        return $cats;
                    }
                    return 'Uncategorized';
                }),
            TD::make('Created By')

            ->render(function (Post $post){
                return $post->user->name;
            }),
            TD::make('Image', 'Image')
                    ->width('150')
                    ->render(function (Post $post) {
                        // Please use view('path')
                        if($post->attachment_id!=NULL){
                            $image=$post->image;
                        return "<img src='{$image->url()}'
                              alt='sample'
                              class='mw-100 d-block img-fluid'>";
                        }else{

                        return 'no image uploaded';
                        }
                    }),

        ];
    }
}
