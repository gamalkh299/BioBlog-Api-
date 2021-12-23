<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryListLayout;
use App\Orchid\Layouts\Category\CategoryRowLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoryListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Category List';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {

        return [
            'category'=>Category::filters()->defaultSort('id', 'desc')->paginate(),
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
            ModalToggle::make('Create Category')
            ->modal('category')
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

            Layout::modal('category', [
                CategoryRowLayout::class,
            ])->async('asyncGetData'),


            CategoryListLayout::class
        ];
    }


    public function asyncGetData($category): array
    {

        return [
            'category' => $category,
        ];
    }
    public function CreateOrUpdate(Category $category , Request $request)
    {
        $category->fill($request->get('category'))->save();

        Toast::success('Category Created Successfully');

    }

    public function delete(Category $category)
    {
        $category->image()->delete();
        $category->posts()->detach();
        $category->delete();
        Toast::success('Category Deleted Successfully');
    }
}
