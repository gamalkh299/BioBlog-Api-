<?php

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use App\Orchid\Layouts\Post\PostRowLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

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
            ->icon('plus')
            ->canSee(!$this->exists),
            Button::make('Update Post')
            ->method('CreateOrUpdate')
            ->icon('pencil')
            ->canSee($this->exists),
            Button::make('Delete')
            ->method('delete')
            ->icon('trash')
            ->canSee($this->exists)
            ->confirm('Are you Sure you want to delete this post ?')

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

    public function CreateOrUpdate(Post $post,Request $request)
    {
            $post->fill($request->get('post'));
            if (!$this->exists){
            $post->user_id=Auth::id();
            }
            $post->save();
            $post->categories()->sync($request->get('post')['categories']);
            $post->tags()->sync($request->get('post')['tags']);
            Toast::success('Post Saved Successfully');
            return  redirect()->route('platform.posts');

    }

    public function delete(Post $post)
    {
        $post->categories()->detach();
        $post->tags()->detach();
        $post->image()->delete();
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('platform.posts');
    }
}
