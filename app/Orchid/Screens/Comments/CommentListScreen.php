<?php

namespace App\Orchid\Screens\Comments;

use App\Models\Comment;
use App\Models\Post;
use App\Orchid\Layouts\Comments\CommentsListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CommentListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Comments';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'Comments'=>Comment::filters()->defaultSort('id', 'desc')->paginate(),
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
            ModalToggle::make('Add Comment')
            ->modal('comment')
            ->modalTitle('Create Comment')
            ->method('CreateOrUpdate')
            ->icon('bubble')
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
            CommentsListLayout::class,
            Layout::modal('comment',[Layout::rows([
                Quill::make('comment.comment')
                ->title('comment')
                ->required()
                ,
                Relation::make('comment.post_id')
                ->fromModel(Post::class,'title','id')
                ->title('Post Title')

            ])])
        ];
    }

    public function CreateOrUpdate(Request $request, Comment $comment)
    {
        $comment->fill($request->get('comment'))->save();
        Toast::success('Comment Saved Successfully');
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        Toast::success('Comment Deleted Successfully');

    }
}
