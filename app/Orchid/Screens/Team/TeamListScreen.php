<?php

namespace App\Orchid\Screens\Team;

use App\Models\Team;
use App\Orchid\Layouts\Team\TeamListlayout;
use App\Orchid\Layouts\Team\TeamRowslayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TeamListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Team List';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'team'=>Team::filters()->defaultSort('id', 'desc')->paginate()
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
            Link::make('Add Member')
                ->route('platform.edit.team')
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
            TeamListlayout::class
        ];
    }




}
