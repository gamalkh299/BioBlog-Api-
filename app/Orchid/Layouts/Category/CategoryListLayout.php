<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category;
use App\Models\Post;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'category';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name','Name')
                ->render(function (Category $category){
                    return ModalToggle::make($category->name)
                        ->modal('category')
                        ->modalTitle('Edit Category')
                        ->method('CreateOrUpdate')
                        ->asyncParameters(['category'=>$category]);

                }),
            TD::make('description','description')
                ->render(function (Category $category){
                    return $category->description;
                }),
            TD::make('Image', 'Image')
                ->width('150')
                ->render(function (Category $category) {
                    // Please use view('path')
                    if($category->attachment_id!=NULL){
                        $image=$category->image;
                        return "<img src='{$image->url()}'
                              alt='sample'
                              class='mw-100 d-block img-fluid'>";
                    }else{

                        return 'no image uploaded';
                    }
                }),

            TD::make('Delete')
                ->alignCenter()
                ->render(function (Category $category){
                    return Button::make('Delete')
                        ->icon('trash')
                        ->method('delete')
                        ->parameters(['category'=>$category->id])
                        ->confirm('Are you sure you want to delete it');
                }),
        ];
    }
}
