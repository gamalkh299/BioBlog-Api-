<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagsResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Tag::all();
        return $this->ApiResponse(TagsResource::collection($data));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts=Post::query()->whereRelation('tags','tags.id','=',$id)->paginate(15);
        if ($posts){
            PostResource::collection($posts);
            return $this->ApiResponse($posts);

        }else{
            return $this->ApiResponse(null,'data Not Found' , 404);
        }
    }
}
