<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Module extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Module ↔ Professeurs
    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class, 'professeur_modules');
    }

    // Module ↔ Students
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_modules');
    }

    // Module ↔ Groupes
    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'groupe_modules');
    }
}
