<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class LessonsController extends Controller
{
    //
    public function index(){
        $lessons = Lesson::all();
        return Response::json([
            'status'=>'success',
            'status_code'=>200,
            'data'=>$lessons->toArray()
        ]);
    }

    public function show($id){
        $lesson =  Lesson::findOrFail($id);
        return Response::json([
            'status'=>'success',
            'status_code'=>200,
            'data'=>$lesson->toArray()
        ]);
    }
}
