<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Professeur;
use App\Models\Groupe;

class QuizController extends Controller
{
    // Use your token middleware
    public function __construct()
    {
        $this->middleware('check.token');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'questions' => 'required|array',
            'questions.*' => 'exists:questions,id',
        ]);

        // Create quiz
        $quiz = Quiz::create([
            'title' => $request->title,
            'duration' => $request->duration,
        ]);

        // Attach questions
        $quiz->questions()->attach($request->questions);

        return response()->json([
            'message' => 'Quiz created successfully',
            'quiz' => $quiz->load('questions', 'professeur', 'groupe')
        ], 201);
    }
}
