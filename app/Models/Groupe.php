<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Groupes ↔ Professeurs
    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class, 'professeur_groupes');
    }

    // Groupes ↔ Students
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_groupes');
    }

    // Groupes ↔ Modules
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'groupe_modules');
    }
}
