<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'duration',
    ];

    // Quiz belongs to a professor
    public function Professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    // Quiz belongs to a group
    public function Groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    // Quiz has many questions (many-to-many)
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
