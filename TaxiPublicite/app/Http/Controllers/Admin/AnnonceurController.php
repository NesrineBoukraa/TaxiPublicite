<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonceur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceurController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user && strcasecmp($user->role, 'admin') == 0) {
            // L'admin récupère TOUTE la table
            $annonceurs = Annonceur::all();
        } else {
            // L'annonceur ne voit que son propre enregistrement
            $annonceurs = Annonceur::where('admin_user_id', $user->id)->get();
        }

        return view('admin.annonceur.index', compact('annonceurs'));
    }

    public function create()
    {
        return view('admin.annonceur.create');
    }

public function store(Request $request)
{
   
    $user = User::create([
        'name'     => $request->nom,
        'email'    => $request->email,
        'password' => Hash::make('password_par_defaut'), 
    ]);

   
    Annonceur::create([
        'nom'               => $request->nom,
        'email'             => $request->email,
        'telephone'         => $request->telephone,
        'adresse'           => $request->adresse,
        'matricule_fiscale' => $request->matricule_fiscale,
        'admin_user_id'     => $user->id, 
    ]);

    return redirect()->route('annonceur.index');
}

    public function show(Annonceur $annonceur)
    {
        $user = Auth::user();
        // Sécurité : l'annonceur ne peut voir que lui-même
        if (strcasecmp($user->role, 'admin') != 0 && $annonceur->admin_user_id !== $user->id) {
            abort(403);
        }
        return view('admin.annonceur.show', compact('annonceur'));
    }

     public function edit(Annonceur $annonceur)
    {
        $user = Auth::user();
        if (strcasecmp($user->role, 'admin') != 0 && $annonceur->admin_user_id !== $user->id) {
            abort(403);
        }
        return view('admin.annonceur.edit', compact('annonceur'));
    }

    public function update(Request $request, Annonceur $annonceur)
    {

             $user = Auth::user();
        if (strcasecmp($user->role, 'admin') != 0 && $annonceur->admin_user_id !== $user->id) {
            abort(403);
        } 

         $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email'     => 'required|email|unique:annonceurs,email,' . $annonceur->id,
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
            'matricule_fiscale'=> 'nullable|string',
        ], [
            'nom.required' => 'le nom est obligatoire',
            'email.unique' => 'le email existe déjà',
            'telephone.required' => 'le telephone est obligatoire',
            'adresse.required' => 'le adresse est obligatoire',
        ]);

        $annonceur->update($data);
        return redirect()->route('annonceur.index');
            }

    public function destroy(Annonceur $annonceur)
    {
        if (strcasecmp(Auth::user()->role, 'admin') != 0) {
            abort(403);
        }
        $annonceur->delete();
        return redirect()->route('annonceur.index')->with('success', 'Annonceur supprimé.');
    }

}