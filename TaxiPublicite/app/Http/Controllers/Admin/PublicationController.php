<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\DossierAnnonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Annonceur;

class PublicationController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if (strcasecmp($user->role, 'admin') == 0) {

        $publications = Publication::with('dossierAnnonce')->get();

    } else {

        $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

        $publications = Publication::whereHas('dossierAnnonce', function ($query) use ($annonceur) {
            $query->where('annonceur_id', $annonceur->id);
        })->with('dossierAnnonce')->get();
    }

    return view('admin.publication.index', compact('publications'));
}

   public function create()
{
    $user = Auth::user();

    if (strcasecmp($user->role, 'admin') == 0) {

        $dossiers = DossierAnnonce::all();

    } else {

        $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

        $dossiers = DossierAnnonce::where('annonceur_id', $annonceur->id)->get();
    }

    return view('admin.publication.create', compact('dossiers'));
}

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

        $user = Auth::user();

if (strcasecmp($user->role, 'admin') != 0) {

    $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

    $dossier = DossierAnnonce::findOrFail($data['dossier_annonce_id']);

    if ($dossier->annonceur_id != $annonceur->id) {
        abort(403);
    }
}

        
  Publication::create($data);
          return redirect()->route('publication.index');
            }

    public function show(Publication $publication)
    {
       
        return view('admin.publication.show', compact('publication'));
    }

    public function edit(Publication $publication)
{
    $user = Auth::user();

    if (strcasecmp($user->role, 'admin') != 0) {

        $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

        if ($publication->dossierAnnonce->annonceur_id != $annonceur->id) {
            abort(403);
        }

        $dossiers = DossierAnnonce::where('annonceur_id', $annonceur->id)->get();

    } else {

        $dossiers = DossierAnnonce::all();
    }

    return view('admin.publication.edit', compact('publication', 'dossiers'));
}

    public function update(Request $request, Publication $publication)
    {
        $user = Auth::user();

if (strcasecmp($user->role, 'admin') != 0) {

    $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

    if ($publication->dossierAnnonce->annonceur_id != $annonceur->id) {
        abort(403);
    }
}
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
    $user = Auth::user();

    if (strcasecmp($user->role, 'admin') != 0) {

        $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

        if ($publication->dossierAnnonce->annonceur_id != $annonceur->id) {
            abort(403);
        }
    }

    $publication->delete();

    return redirect()->route('publication.index');
}

   
}