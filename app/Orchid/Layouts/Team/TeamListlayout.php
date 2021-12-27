<?php

namespace App\Orchid\Layouts\Team;

use App\Models\Team;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TeamListlayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'team';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name','Member')
            ->render(function (Team $team){
                return  Link::make($team->name)
                            ->route('platform.edit.team',['team'=>$team->id]);

            }),
            TD::make('Job')
                ->render(function (Team $team){
                    return $team->job;
                }),

            TD::make('WhatsApp')
                ->render(function (Team $team){
                    return $team->whatsapp? :'not added yet';
                }),
            TD::make('Facebook')
                ->render(function (Team $team){
                    return $team->facebook? :'not added yet';
                }),

            TD::make('Twitter')
                ->render(function (Team $team){
                    return $team->twitter? :'not added yet';
                }),

            TD::make('Image', 'Image')
                ->width('150')
                ->render(function (Team $team) {
                    // Please use view('path')
                    if($team->attachment_id!=NULL){
                        $image=$team->image;
                        return "<img src='{$image->url()}'
                              alt='sample'
                              class='mw-100 d-block img-fluid'>";
                    }else{

                        return 'no image uploaded';
                    }
                }),


        ];
    }
}
