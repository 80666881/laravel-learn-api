<?php

namespace App\Http\Controllers;

use App\Transformer\LessonTransformer;
use Illuminate\Http\Request;
use App\Lesson;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class LessonsController extends ApiController {
    protected $lessonTransformer;

    public function __construct(LessonTransformer $lessonTransformer) {
        $this->lessonTransformer = $lessonTransformer;
        $this->middleware('auth.basic',['only'=>'store','update']);
    }

    public function index() {
        $lessons = Lesson::all();
        return $this->response([
            'status' => 'success',
            'data' => $this->lessonTransformer->transformCollection($lessons)
        ]);
    }

    public function show($id) {
        $lesson = Lesson::find($id);
        //没有找到应该返回404
        if (!$lesson) {
            return $this->responseNotFound();
        }
        return $this->response([
            'status' => 'success',
            'data' => $this->lessonTransformer->transform($lesson)

        ]);
    }

    public function store(Request $request){
        if(!$request->get('title') or ! $request->get('body')){
            return $this->setStatusCode(422)->responseError('validate failed');
        }
        Lesson::create($request->all());
        return $this->setStatusCode(201)->response([
            'status'=>'success',
            'message'=>'lesson created'
        ]);
    }
}
