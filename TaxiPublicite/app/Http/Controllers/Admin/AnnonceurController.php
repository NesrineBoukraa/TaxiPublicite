<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonceur;
use Illuminate\Http\Request;

class AnnonceurController extends Controller
{
    public function index()
    {
        $annonceurs = Annonceur::all();
        return view('admin.annonceur.index', compact('annonceurs'));
    }

    public function create()
    {
        return view('admin.annonceur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'       => 'required',
            'email'     => 'required|email|unique:annonceurs,email',
            'telephone' => 'required',
            'adresse'   => 'required|',
        ], [
            'nom.required' => 'le nom est obligatoire',
            'email.unique' => 'le email existe déjà',
             'telephone.required' => 'le telephone est obligatoire',
            'adresse.required' => 'le adresse est obligatoire',
            ]);

        Annonceur::create($request->all());
        return redirect()->route('annonceur.index');
            }

    public function show(Annonceur $annonceur)
    {
        return view('admin.annonceur.show', compact('annonceur'));
    }

    public function edit(Annonceur $annonceur)
    {
        return view('admin.annonceur.edit', compact('annonceur'));
    }

    public function update(Request $request, Annonceur $annonceur)
    {
         $data = $request->validate([
            'nom'       => 'required',
            'email'     => 'required|email|unique:annonceurs,email,' . $annonceur->id,
            'telephone' => 'required|string|max:20',
            'adresse'   => 'required|string|max:255',
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
        $annonceur->delete();
        return redirect()->route('annonceur.index');
            }

}