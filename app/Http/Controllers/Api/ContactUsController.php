<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
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
        $validation=Validator::make($request->all(),[
           'name'=>'required',
           'email'=>'required:email',
           'phone'=>'required',
           'message'=>'required'
       ]);
       if ($validation->fails()){
           return $this->ApiResponse('null',$validation->errors(),'422');
       }
       ContactUs::create($request->all());
       return $this->ApiResponse('Message Send Successfully');

    }
}
