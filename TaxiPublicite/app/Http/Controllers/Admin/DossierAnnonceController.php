<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DossierAnnonce;
use App\Models\Annonceur;
use App\Models\ServicePublicitaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DossierAnnonceController extends Controller
{
     public function index()
    {
        $user = Auth::user();

        // Vérification du rôle admin (insensible à la casse)
        if ($user && strcasecmp($user->role, 'admin') == 0) {
            // L'admin voit TOUT
            $dossierannonces = DossierAnnonce::with(['annonceur', 'servicePublicitaire'])->get();
        } else {
            // L'annonceur ne voit que les siens
            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

            if ($annonceur) {
                $dossierannonces = DossierAnnonce::where('annonceur_id', $annonceur->id)
                    ->with(['annonceur', 'servicePublicitaire'])
                    ->get();
            } else {
                $dossierannonces = collect(); // Évite l'erreur 500 si profil manquant
            }
        }

        return view('admin.dossierannonce.index', compact('dossierannonces'));
    }

    public function create()
    {
        $user = Auth::user();
        $services = ServicePublicitaire::where('actif', true)->get();
        
        // L'admin peut choisir n'importe quel annonceur, l'annonceur n'en voit aucun (fixé en store)
        $annonceurs = (strcasecmp($user->role, 'admin') == 0) ? Annonceur::all() : null;

        return view('admin.dossierannonce.create', compact('annonceurs', 'services'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'datecreation'            => 'required|date',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
        ];

        if (strcasecmp($user->role, 'admin') == 0) {
            $rules['annonceur_id'] = 'required|exists:annonceurs,id';
        }

        $data = $request->validate($rules);

        if (strcasecmp($user->role, 'admin') != 0) {
            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();
            if (!$annonceur) {
                return back()->withErrors(['error' => 'Profil annonceur introuvable.']);
            }
            $data['annonceur_id'] = $annonceur->id;
        }

        DossierAnnonce::create($data);
        return redirect()->route('dossierannonce.index')->with('success', 'Dossier créé avec succès.');
    }

    public function show(DossierAnnonce $dossierannonce)
    {
        $user = Auth::user();
        if (strcasecmp($user->role, 'admin') != 0) {
            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();
            if (!$annonceur || $dossierannonce->annonceur_id !== $annonceur->id) {
                abort(403);
            }
        }
        return view('admin.dossierannonce.show', compact('dossierannonce'));
    }

    public function edit(DossierAnnonce $dossierannonce)
    {
        $user = Auth::user();
        if (strcasecmp($user->role, 'admin') != 0) {
            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();
            if (!$annonceur || $dossierannonce->annonceur_id !== $annonceur->id) {
                abort(403);
            }
        }

        $annonceurs = (strcasecmp($user->role, 'admin') == 0) ? Annonceur::all() : null;
        $services = ServicePublicitaire::all();

        return view('admin.dossierannonce.edit', compact('dossierannonce', 'annonceurs', 'services'));
    }

    public function update(Request $request, DossierAnnonce $dossierannonce)
    {
        $user = Auth::user();
        $rules = [
            'datecreation'            => 'required|date',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
        ];

        if (strcasecmp($user->role, 'admin') == 0) {
            $rules['annonceur_id'] = 'required|exists:annonceurs,id';
        }

        $data = $request->validate($rules);

        if (strcasecmp($user->role, 'admin') != 0) {
            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();
            $data['annonceur_id'] = $annonceur->id;
        }

        $dossierannonce->update($data);
        return redirect()->route('dossierannonce.index')->with('success', 'Dossier mis à jour.');
    }

    public function destroy(DossierAnnonce $dossierannonce)
    {
        if (strcasecmp(Auth::user()->role, 'admin') != 0) {
            abort(403);
        }
        $dossierannonce->delete();
        return redirect()->route('dossierannonce.index')->with('success', 'Dossier supprimé.');
    }
    public function byAnnonceur($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $annonceur = Annonceur::findOrFail($id);
        $dossierannonces = DossierAnnonce::where('annonceur_id', $id)->get();

        return view('admin.dossierannonce.index', compact('dossierannonces', 'annonceur'));
    }


}
