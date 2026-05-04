<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatutValidation;
use App\Models\DossierAnnonce;
use Illuminate\Http\Request;

class StatutValidationController extends Controller
{
    public function index()
    {
        $statuts = StatutValidation::with('dossierAnnonces')->get();
        return view('admin.statutvalidation.index', compact('statuts'));
    }

    public function create()
    {
        $dossiers = DossierAnnonce::whereDoesntHave('statutValidation')->get();
        return view('admin.statutvalidation.create', compact('dossiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle'            => 'required|string|max:255',
            'datevalidation'     => 'required|date',
            'commentaire'        => 'nullable|string',
            'dossier_annonce_id' => 'required|exists:dossier_annonces,id|unique:statut_validations,dossier_annonce_id',
        ], [
            'libelle.required'            => 'Le libellé est obligatoire',
            'datevalidation.required'     => 'La date de validation est obligatoire',
            'datevalidation.date'         => 'La date de validation n\'est pas valide',
            'dossier_annonce_id.required' => 'Le dossier est obligatoire',
            'dossier_annonce_id.exists'   => "Le dossier sélectionné n'existe pas",
            'dossier_annonce_id.unique'   => 'Ce dossier a déjà un statut de validation',
        ]);

        StatutValidation::create($request->all());
        return redirect()->route('statutvalidation.index');
            }

    public function show(StatutValidation $statutvalidation)
    {
        $statutvalidation->load('dossierAnnonces');
        return view('admin.statutvalidation.show', compact('statutvalidation'));
    }

    public function edit(StatutValidation $statutvalidation)
    {
        $dossiers = DossierAnnonce::whereDoesntHave('statutValidation')
                        ->orWhere('id', $statutvalidation->dossier_annonce_id)
                        ->get();
        return view('admin.statutvalidation.edit', compact('statutvalidation', 'dossiers'));
    }

    public function update(Request $request, StatutValidation $statutvalidation)
    {
        $request->validate([
            'libelle'        => 'required|string|max:255',
            'datevalidation' => 'required|date',
            'commentaire'    => 'nullable|string',
        ], [
            'libelle.required'        => 'Le libellé est obligatoire',
            'datevalidation.required' => 'La date de validation est obligatoire',
            'datevalidation.date'     => 'La date de validation n\'est pas valide',
        ]);

        $statutvalidation->update($request->all());
        return redirect()->route('statutvalidation.index');
            }

    public function destroy(StatutValidation $statutvalidation)
    {
        $statutvalidation->delete();
        return redirect()->route('statutvalidation.index');
            }
}