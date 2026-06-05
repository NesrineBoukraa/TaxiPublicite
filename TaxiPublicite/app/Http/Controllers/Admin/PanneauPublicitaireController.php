<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanneauPublicitaire;
use App\Models\ServicePublicitaire;
use Illuminate\Http\Request;

class PanneauPublicitaireController extends Controller
{
    public function index()
    {
        $panneaux = PanneauPublicitaire::with('servicePublicitaire')->get();
        return view('admin.panneaupublicitaire.index', compact('panneaux'));
    }

    public function create()
    {
        $services = ServicePublicitaire::all();
        return view('admin.panneaupublicitaire.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nompanneau'              => 'required|string|max:255',
            'largeur'                 => 'required|numeric|min:0',
            'hauteur'                 => 'required|numeric|min:0',
            'disponible'              => 'boolean',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
        ], [
            'nompanneau.required'              => 'Le nom du panneau est obligatoire',
            'largeur.required'                 => 'La largeur est obligatoire',
            'largeur.numeric'                  => 'La largeur doit être un nombre',
            'hauteur.required'                 => 'La hauteur est obligatoire',
            'hauteur.numeric'                  => 'La hauteur doit être un nombre',
            'service_publicitaire_id.required' => 'Le service est obligatoire',
            'service_publicitaire_id.exists'   => "Le service sélectionné n'existe pas",
        ]);

        PanneauPublicitaire::create($request->all());
        return redirect()->route('panneaupublicitaire.index');
            }

    public function show(PanneauPublicitaire $panneaupublicitaire)
    {
        $panneaupublicitaire->load('servicePublicitaire', 'timeSheets');
        return view('admin.panneaupublicitaire.show', compact('panneaupublicitaire'));
    }

    public function edit(PanneauPublicitaire $panneaupublicitaire)
    {
        $services = ServicePublicitaire::all();
        return view('admin.panneaupublicitaire.edit', compact('panneaupublicitaire', 'services'));
    }

    public function update(Request $request, PanneauPublicitaire $panneaupublicitaire)
    {
        $request->validate([
            'nompanneau'              => 'required|string|max:255',
            'largeur'                 => 'required|numeric|min:0',
            'hauteur'                 => 'required|numeric|min:0',
            'disponible'              => 'boolean',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
        ], [
            'nompanneau.required'              => 'Le nom du panneau est obligatoire',
            'largeur.required'                 => 'La largeur est obligatoire',
            'hauteur.required'                 => 'La hauteur est obligatoire',
            'service_publicitaire_id.required' => 'Le service est obligatoire',
            'service_publicitaire_id.exists'   => "Le service sélectionné n'existe pas",
        ]);

        $panneaupublicitaire->update($request->all());
        return redirect()->route('panneaupublicitaire.index');
            }

    public function destroy(PanneauPublicitaire $panneaupublicitaire)
    {
        $panneaupublicitaire->delete();
        return redirect()->route('panneaupublicitaire.index');
            }



    
}