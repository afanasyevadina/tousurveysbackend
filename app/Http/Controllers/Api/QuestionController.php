<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionDetailResource;
use App\Http\Resources\QuestionResource;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }

    public function show($id)
    {
        $question = Question::find($id);
        if(!$question)
            return response()->json([
                'errors' => [
                    'error' => 'Not Found',
                ],
            ])->setStatusCode(404);
        return QuestionDetailResource::make($question);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => ['required', 'string'],
            'variants' => ['required', 'array'],
            'variants.*.text' => ['required', 'string'],
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => collect($validator->errors())->map(function ($item) {
                    return $item[0];
                }),
            ])->setStatusCode(422);
        }
        $question = auth()->user()->questions()->create([
            'text' => $request->text,
        ]);
        foreach($request->variants as $variant) {
            $question->variants()->create($variant);
        }
        return response()->noContent()->setStatusCode(201);
    }
}
