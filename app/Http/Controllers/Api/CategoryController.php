<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
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
        $data=Category::with('posts')->paginate(15);
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
        $cat=Category::with('posts')->where('id',$id)->get();
//        dd($cat);
        if ($cat){
            $data=CategoryResource::collection($cat);
            return $this->ApiResponse($data);

        }else{
            return $this->ApiResponse(null,'data Not Found' , 404);
        }
    }


}
