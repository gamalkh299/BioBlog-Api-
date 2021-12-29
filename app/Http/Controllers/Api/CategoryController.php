<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Category::paginate(15);
        CategoryResource::collection($data);
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
        $posts=Post::query()->whereRelation('categories','categories.id','=',$id)->paginate(15);
        if ($posts){
            PostResource::collection($posts);
            return $this->ApiResponse($posts);

        }else{
            return $this->ApiResponse(null,'data Not Found' , 404);
        }
    }


}
