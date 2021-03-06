<?php

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use App\Orchid\Layouts\Post\PostListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class PostListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Post List';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        if (Auth::user()->hasAccess('platform.systems.roles')){
            $posts=Post::filters()->defaultSort('id', 'desc')->paginate();
        }else{

        $posts=Post::where('user_id',Auth::id())->get();
        }
        return [
            'posts'=> $posts,
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
            Link::make('Create post')
                ->icon('pencil')
                ->route('platform.posts.edit')
                ,
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
        PostListLayout::class

        ];
    }
}
