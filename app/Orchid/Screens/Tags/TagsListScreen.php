<?php

namespace App\Orchid\Screens\Tags;

use App\Models\Tag;
use App\Orchid\Layouts\Tags\TagsListLayout;
use App\Orchid\Layouts\Tags\TagsRowsLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TagsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Tags List';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'tags'=>Tag::filters()->defaultSort('id', 'desc')->paginate(),

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
            ModalToggle::make('Create Tag')
                ->modal('tag')
                ->modalTitle('Create')
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
            Layout::modal('tag', [
                TagsRowsLayout::class,
            ])->async('asyncGetData'),


            TagsListLayout::class
        ];
    }

    public function asyncGetData($tag): array
    {
        return [
            'tag' => $tag,
        ];
    }

    public function CreateOrUpdate(Tag $tag ,Request $request)
    {
        $tag->fill($request->get('tag'))->save();

        Toast::success('Tag Saved Successfully');

    }
    public function delete(Tag $tag)
    {
        $tag->posts()->detach();
        $tag->delete();
        Toast::success('Tag Deleted Successfully');
    }
}
