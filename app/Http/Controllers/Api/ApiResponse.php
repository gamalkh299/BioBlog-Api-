<?php

namespace App\Http\Controllers\Api;

trait ApiResponse
{

    public function ApiResponse($data,$error=null,$code=200)
    {
        $array=[
            'data'=>$data,
            'code'=> $code == 200 ? true : false ,
            'error'=>$error,
        ];

         return response($array , 200);

    }

//    public function PaginateData($data)
//    {
//        return [
//            'data'=>$data,
//            'pagination'=>[
//                'current_page' => $data->toArray()['current_page'],
//                'total' => $data->toArray()['total'],
//                'per_page' => $data->toArray()['per_page'],
//                'last_page' => $data->toArray()['last_page'],
//                'next_page_url'=>$data->toArray()['next_page_url'],
//            ]
//         ];
//
//
//    }

}
