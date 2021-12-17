<?php

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use App\Orchid\Layouts\Post\PostRowLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class PostEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create Post';

    public $exists=false;


    /**
     * Query data.
     *
     * @return array
     */
    public function query(Post $post): array
    {
        $this->exists=$post->exists;
        if ($this->exists){
            $this->name='edit';
        }


        return [
            'post'=>$post
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
            Button::make('Create Post')
            ->method('CreateOrUpdate')
            ->icon('plus'),

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
            PostRowLayout::class
        ];
    }

    public function CreateOrUpdate(Request $request, Post $post)
    {
//       dd($request);
            $post->fill($request->get('post'));
            if (!$this->exists){
            $post->user_id=Auth::id();
            }
            $post->save();
            return  redirect()->route('platform.posts');

            // post->user
            //title => 'ahmed'
    }
}
