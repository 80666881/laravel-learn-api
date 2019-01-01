<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class LessonsController extends Controller {
    //
    public function index() {
        $lessons = Lesson::all();
        return Response::json([
            'status' => 'success',
            'status_code' => 200,
            'data' => $this->transformCollection($lessons)]);
    }

    public function show($id) {
        $lesson = Lesson::findOrFail($id);
        return Response::json([
            'status' => 'success',
            'status_code' => 200,
            'data' => $this->transform($lesson)]);
    }

    private function transform($lesson) {
            return [
                'title' => $lesson['title'],
                'content' => $lesson['body'],
                'is_free' => (boolean)$lesson['free']
            ];
    }
    private function transformCollection($lessons) {
        return array_map([$this,'transform'], $lessons->toArray());
    }
}
