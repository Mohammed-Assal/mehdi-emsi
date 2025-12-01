
<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'matricule'];

    protected $hidden = ['password', 'remember_token'];

    // Student ↔ Groupes
    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'student_groupes');
    }

    // Student ↔ Modules
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'student_modules');
    }

    // Student ↔ Professeurs
    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class, 'professeur_students');
    }
}
