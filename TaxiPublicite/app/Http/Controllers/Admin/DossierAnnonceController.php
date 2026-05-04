<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DossierAnnonce;
use App\Models\Annonceur;
use App\Models\ServicePublicitaire;
use Illuminate\Http\Request;

class DossierAnnonceController extends Controller
{
    public function index()
    {
 $dossierannonces = DossierAnnonce::all();
         return view('admin.dossierannonce.index', compact('dossierannonces'));
    }

    public function create()
    {
        $annonceurs = Annonceur::all();
        $services   = ServicePublicitaire::all();
        return view('admin.dossierannonce.create', compact('annonceurs', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
       'datecreation' => 'required',
            'annonceur_id' => 'required',
            'service_publicitaire_id' => 'required',
        ],[
            'datecreation.required' => 'la datecreation est obligatoire',

        ]);

        DossierAnnonce::create($data);
        return redirect()->route('dossierannonce.index');
                       
    }

    public function show(DossierAnnonce $dossierannonce)
    {
        return view('admin.dossierannonce.show', compact('dossierannonce'));
    }

    public function edit(DossierAnnonce $dossierannonce)
    {
        $annonceurs = Annonceur::all();
        $services   = ServicePublicitaire::all();
        return view('admin.dossierannonce.edit', compact('dossierannonce', 'annonceurs', 'services'));
    }

    public function update(Request $request, DossierAnnonce $dossierannonce)
    {
       $data =  $request->validate([
            'datecreation'            => 'required|date',
            'annonceur_id'            => 'required|exists:annonceurs,id',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
        ], [
            'datecreation.required'            => 'La date de création est obligatoire',
           
        ]);

      $dossierAnnonce->update($data);
        return redirect()->route('dossierannonce.index');
            }

    public function destroy(DossierAnnonce $dossierannonce)
    {
        $dossierannonce->delete();
        return redirect()->route('dossierannonce.index');
            }

    
}