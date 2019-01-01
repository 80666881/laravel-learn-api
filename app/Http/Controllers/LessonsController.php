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
            'data' => $this->transform($lessons)]);
    }

    public function show($id) {
        $lesson = Lesson::findOrFail($id);
        return Response::json(['status' => 'success', 'status_code' => 200, 'data' => $lesson->toArray()]);
    }

    private function transform($lessons) {
        return array_map(function ($lesson) {
            return [
                'title' => $lesson['title'],
                'content' => $lesson['body'],
                'is_free' => (boolean)$lesson['free']
            ];
        }, $lessons->toArray());
    }
}
