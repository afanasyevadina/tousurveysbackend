<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionDetailResource;

class QuestionController extends Controller
{
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }
    
    public function show($id)
    {
        $question = Question::find($id);
        if(!$question) {
            return response()->json([
                'errors' => [
                    'error' => 'Not Found',
                ],
            ])->setStatusCode(404);
        }
        return QuestionDetailResource::make($question);
    }
    
    public function store(Request $request)
    {
        //
    }
}
