<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::published()->paginate(15);
        PostResource::collection($data);
        return $this->ApiResponse($data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);

        if ($post){
            return $this->ApiResponse(new PostResource($post));

        }else{
            return $this->ApiResponse(null,'data Not Found' , 404);
        }
    }

    public function GetLatestPosts()
    {
        $data = Post::latest()->take(15)->paginate();
        PostResource::collection($data);
        return $this->ApiResponse($data);

    }

    public function GetMostReaded()
    {
        $data = Post::all()->random(10);
        PostResource::collection($data);
        return $this->ApiResponse($data);

    }

    public function GetPostComments($id)
    {


    }



}
