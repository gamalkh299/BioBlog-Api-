<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryRowLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class CategoryEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create Category';
    public $exists=false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): array
    {
        $this->exists=$category->exists;
        if ($this->exists){
            $this->name='Edit Category';

        }

        return [
            'category'=>$category,
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
            Button::make('Create')
            ->icon('plus')
            ->method('CreateOrUpdate')
            ->canSee(!$this->exists),
            Button::make('Update')
            ->icon('pencil')
            ->method('CreateOrUpdate')
            ->canSee($this->exists),
            Button::make('Delete')
                ->icon('trash')
                ->method('delete')
                ->canSee($this->exists),


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
            CategoryRowLayout::class
        ];
    }


}
