<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\QuestionResultResource;

class AnswerController extends Controller
{
    public function store(Request $request, $id)
    {
        $question = Question::find($id);
        if(!$question) {
            return response()->json([
                'errors' => [
                    'error' => 'Not Found',
                ],
            ])->setStatusCode(404);
        }
        $validator = Validator::make($request->all(), [
            'variant_id' => ['required', 'in:' . $question->variants->pluck('id')->implode(',')],
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => collect($validator->errors())->map(function($item) {
                    return $item[0];
                }),
            ])->setStatusCode(422);
        }
        auth()->user()->answers()->updateOrCreate([
            'question_id' => $question->id,
        ], [
            'variant_id' => $request->variant_id,
        ]);
        return response()->noContent()->setStatusCode(201);
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
        if(!$question->hasAnswer) {
            return response()->json([
                'errors' => [
                    'error' => 'You have not submitted an answer',
                ],
            ])->setStatusCode(403);
        }
        return QuestionResultResource::make($question);
    }
}
