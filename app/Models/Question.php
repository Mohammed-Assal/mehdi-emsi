<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'choices',
        'correct_choices', // note plural
    ];

    protected $casts = [
        'choices' => 'array',
        'correct_choices' => 'array', // multiple correct answers
    ];

    // Hide correct answers from API/frontend
    protected $hidden = [
        'correct_choices',
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }
}
