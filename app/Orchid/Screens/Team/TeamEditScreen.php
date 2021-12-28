<?php

namespace App\Orchid\Screens\Team;

use App\Models\Team;
use App\Orchid\Layouts\Team\TeamRowslayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class TeamEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create Member';
    public $exists=false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Team $team): array
    {
        $this->exists=$team->exists;
        if ($this->exists){
            $this->name='Edit Member';
        }
        return [
            'team'=>$team
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
            Button::make('Create Member')
                ->method('CreateOrUpdate')
                ->icon('plus')
                ->canSee(!$this->exists),
            Button::make('Update Member')
                ->method('CreateOrUpdate')
                ->icon('pencil')
                ->canSee($this->exists),
            Button::make('Delete')
                ->method('delete')
                ->icon('trash')
                ->canSee($this->exists)
                ->confirm('Are you Sure you want to delete this Member?')

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
            TeamRowslayout::class
        ];
    }

    public function CreateOrUpdate(Team $team, Request $request)
    {

        $team->fill($request->get('team'));
        $team->image=$request->get('team')['attachment_id'];
        $team->save();
        Toast::success('Member Saved Successfully');
        return redirect()->route('platform.team');

    }

    public function delete(Team $team)
    {
        $team->image()->delete();
        $team->delete();
        Toast::success('Member Deleted Successfully');
        return redirect()->route('platform.team');
    }

}
