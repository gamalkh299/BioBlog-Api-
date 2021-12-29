<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\AbstractPaginator;
use PhpParser\Node\Expr\New_;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                    'id'=> $this->id,
                    'title'=>$this->title,
                    'description'=>$this->description,
                    'image'=> $this->image,
                    'created_at'=> \Carbon\Carbon::parse($this->created_at)->diffForHumans(),
                    'user'=>$this->user,
                    'tags'=>$this->tags,
                    'categories'=>$this->categories,
                    'comments'=>$this->comments,

        ];
    }
}
