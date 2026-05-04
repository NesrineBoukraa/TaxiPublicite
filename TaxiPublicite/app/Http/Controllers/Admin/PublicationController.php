<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\DossierAnnonce;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::with('dossierAnnonce')->get();
        return view('admin.publication.index', compact('publications'));
    }

    public function create()
    {
 return view('admin.publication.create', [
            'dossiers' => DossierAnnonce::all(),
        ]);    }

    public function store(Request $request)
    {
      $data =   $request->validate([
            'titre'              => 'required',
            'contenu'            => 'required',
            'datepublication'    => 'required',
            'actif'              => 'boolean',
            'urlmedia'           => 'nullable|url|max:255',
            'dossier_annonce_id' => 'required|exists:dossier_annonces,id',
        ], [
            'titre.required' => 'le titre de la publication est obligatoire',
            'contenu.required' => 'le contenu est obligatoire',
            'datepublication.required' => 'la date de publication est obligatoire',
            'urlmedia.required' => 'Url media est obligatoire',
            'dossier_annonce_id.required' => 'le dossier annonce est obligatoire',
        ]);

        
  Publication::create($data);
          return redirect()->route('publication.index');
            }

    public function show(Publication $publication)
    {
       
        return view('admin.publication.show', compact('publication'));
    }

    public function edit(Publication $publication)
    {
        $dossiers = DossierAnnonce::all();
        return view('admin.publication.edit', compact('publication','dossiers'));
    }

    public function update(Request $request, Publication $publication)
    {
        $data = $request->validate([
    'titre'              => 'required',
    'contenu'            => 'required',
    'datepublication'    => 'required',
    'actif'              => 'boolean',
    'urlmedia'           => 'nullable|url|max:255',
    'dossier_annonce_id' => 'required|exists:dossier_annonces,id',
], [
'titre.required' => 'le titre de la publication est obligatoire',
            'contenu.required' => 'le contenu est obligatoire',
            'datepublication.required' => 'la date de publication est obligatoire',
            'urlmedia.required' => 'Url media est obligatoire',        ]);

          $publication->update($data);
        return redirect()->route('publication.index');
            }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('publication.index');
    }

   
}