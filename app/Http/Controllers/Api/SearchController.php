<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class SearchController extends Controller
{
    use ApiResponseTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $result= Post::query()->where('title','LIKE','%'.$request->search.'%')
                            ->orWhere('description','LIKE','%'.$request->search.'%')
                            ->paginate(10);
        if (!$result->isEmpty()){
            PostResource::collection($result);
            return $this->ApiResponse($result);

        }
        return $this->ApiResponse(null,'There Is No Matches Found',404);
    }
}
