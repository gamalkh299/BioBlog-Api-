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
            'category'=>Category::all(),
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
            ]),


            CategoryListLayout::class
        ];
    }
    public function CreateOrUpdate(Request $request,Category $category)
    {
        $category->fill($request->get('category'))->save();

    }

    public function delete()
    {

    }
}
