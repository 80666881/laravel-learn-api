<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Http\Requests;

class LessonsController extends Controller
{
    //
    public function index(){
        return Lesson::all();//返回全部数据，json格式
    }

    public function show($id){
        return Lesson::findOrFail($id);
    }
}
