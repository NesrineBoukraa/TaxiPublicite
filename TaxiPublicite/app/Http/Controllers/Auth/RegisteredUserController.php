<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Annonceur;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // Ajoutez vos champs annonceur ici si vous les avez mis dans le formulaire
        'telephone' => ['nullable', 'string'], 
        'adresse' => ['nullable', 'string'],
    ]);

    // 1. Création de l'utilisateur (Authentification)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // 2. Création automatique du profil Annonceur lié
    Annonceur::create([
        'nom' => $user->name,
        'email' => $user->email,
        'telephone' => $request->telephone ?? '', // Valeur par défaut si vide
        'adresse' => $request->adresse ?? '',
        'admin_user_id' => $user->id, // LE LIEN IMPORTANT
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}
