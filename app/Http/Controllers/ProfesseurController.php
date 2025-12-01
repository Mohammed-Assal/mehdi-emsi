<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfesseurController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:555',
            'email'     => 'required|email|unique:professeurs,email',
            'password'  => 'required|string|min:6',
            'matricule' => 'required|string|max:50|unique:professeurs,matricule',
        ]);

        $prof = Professeur::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'matricule' => $validated['matricule'],
        ]);

        return response()->json([
            'message' => 'Professeur created successfully',
            'data'    => $prof
        ], 201);
    }

    public function login(Request $request)
{

    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    $prof = Professeur::where('email', $request->email)->first();

    if (! $prof || ! Hash::check($request->password, $prof->password)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    // Generate token (using Sanctum)
    $token = $prof->createToken('professeur_token')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'data'    => [
            'professeur' => $prof,
            'token'      => $token
        ]
    ]);
}

}
