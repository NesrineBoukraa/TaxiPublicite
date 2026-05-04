<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePublicitaire;
use App\Models\Annonceur;
use Illuminate\Http\Request;

class ServicePublicitaireController extends Controller
{
    public function index()
    {
        $services = ServicePublicitaire::with('annonceur')->get();
        return view('admin.servicepublicitaire.index', compact('services'));
    }

    public function create()
    {
        $annonceurs = Annonceur::all();
        return view('admin.servicepublicitaire.create', compact('annonceurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomservice'              => 'required|string|max:255',
            'description'             => 'required|string',
            'tarif'                   => 'required|numeric|min:0',
            'dureejour'               => 'required|integer|min:1',
            'actif'                   => 'boolean',
            'annonceur_id'            => 'required|exists:annonceurs,id',
            'produit_id'              => 'nullable|integer',
        ], [
            'nomservice.required'  => 'Le nom du service est obligatoire',
            'description.required' => 'La description est obligatoire',
            'tarif.required'       => 'Le tarif est obligatoire',
            'tarif.numeric'        => 'Le tarif doit être un nombre',
            'dureejour.required'   => 'La durée est obligatoire',
            'annonceur_id.required'=> "L'annonceur est obligatoire",
            'annonceur_id.exists'  => "L'annonceur sélectionné n'existe pas",
        ]);

        ServicePublicitaire::create($request->all());
        return redirect()->route('servicepublicitaire.index');
    }

    public function show(ServicePublicitaire $servicepublicitaire)
    {
        $servicepublicitaire->load('annonceur', 'dossierAnnonces', 'timeSheets');
        return view('admin.servicepublicitaire.show', compact('servicepublicitaire'));
    }

    public function edit(ServicePublicitaire $servicepublicitaire)
    {
        $annonceurs = Annonceur::all();
        return view('admin.servicepublicitaire.edit', compact('servicepublicitaire', 'annonceurs'));
    }

    public function update(Request $request, ServicePublicitaire $servicepublicitaire)
    {
        $request->validate([
            'nomservice'   => 'required|string|max:255',
            'description'  => 'required|string',
            'tarif'        => 'required|numeric|min:0',
            'dureejour'    => 'required|integer|min:1',
            'actif'        => 'boolean',
            'annonceur_id' => 'required|exists:annonceurs,id',
            'produit_id'   => 'nullable|integer',
        ], [
            'nomservice.required'  => 'Le nom du service est obligatoire',
            'description.required' => 'La description est obligatoire',
            'tarif.required'       => 'Le tarif est obligatoire',
            'tarif.numeric'        => 'Le tarif doit être un nombre',
            'dureejour.required'   => 'La durée est obligatoire',
            'annonceur_id.required'=> "L'annonceur est obligatoire",
            'annonceur_id.exists'  => "L'annonceur sélectionné n'existe pas",
        ]);

        $servicepublicitaire->update($request->all());
        return redirect()->route('servicepublicitaire.index');
                        
    }

    public function destroy(ServicePublicitaire $servicepublicitaire)
    {
        $servicepublicitaire->delete();
        return redirect()->route('servicepublicitaire.index');
                       
    }

    //récupère tous les panneaux publicitaires liés à ce service
    public function panneaux(ServicePublicitaire $servicepublicitaire)
    {
        $panneaux = $servicepublicitaire->panneauPublicitaires;
        return view('admin.servicepublicitaire.panneaux', compact('servicepublicitaire', 'panneaux'));
    }

    //récupère les horaires / planifications du service
    public function timeSheets(ServicePublicitaire $servicepublicitaire)
    {
        $timeSheets = $servicepublicitaire->timeSheets;
        return view('admin.servicepublicitaire.timesheets', compact('servicepublicitaire', 'timeSheets'));
    }
}