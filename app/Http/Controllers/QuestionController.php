<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::withCount('variants')->withCount('answers')->get();
        return view('questions', [
            'questions' => $questions,
        ]);
    }

    public function view($id)
    {
        $question = Question::findOrFail($id);
        return view('question', [
            'question' => $question,
        ]);
    }
}
