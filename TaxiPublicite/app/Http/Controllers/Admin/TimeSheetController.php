<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonceur;
use App\Models\TimeSheet;
use App\Models\ServicePublicitaire;
use App\Models\PanneauPublicitaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeSheetController extends Controller
{
    private function getAnnonceurConnecte()
    {
        return Annonceur::where('admin_user_id', Auth::id())->first();
    }

    private function isAdmin(): bool
    {
        return Auth::user()->role === 'admin';
    }


    public function index()
    {
        if ($this->isAdmin()) {
            $timeSheets = TimeSheet::with([
                'annonceur',
                'servicePublicitaire',
                'panneauPublicitaire',
            ])->get();
        } else {
            $annonceur  = $this->getAnnonceurConnecte();
            $timeSheets = TimeSheet::with(['servicePublicitaire', 'panneauPublicitaire'])
                ->where('annonceur_id', $annonceur->id)
                ->get();
        }

        return view('admin.timesheet.index', compact('timeSheets'));
    }

    public function create()
    {
        $panneaux = PanneauPublicitaire::all();

        $services = ServicePublicitaire::all(); // global : accessible à tous

        if ($this->isAdmin()) {
            $annonceurs = Annonceur::all();
        } else {
            $annonceur  = $this->getAnnonceurConnecte();
            $annonceurs = collect([$annonceur]);
        }

        return view('admin.timesheet.create', compact('annonceurs', 'services', 'panneaux'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'datedebut'               => 'required|date',
            'datefin'                 => 'required|date|after_or_equal:datedebut',
            'heuredebut'              => 'required',
            'heurefin'                => 'required',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
            'panneau_publicitaire_id' => 'required|exists:panneau_publicitaires,id',
            'annonceur_id'            => 'required|exists:annonceurs,id',
        ]);

        if (!$this->isAdmin()) {
            $annonceur = $this->getAnnonceurConnecte();

            if (!$annonceur) {
                abort(403, 'Aucun profil annonceur lié à ce compte.');
            }

            $data['annonceur_id'] = $annonceur->id;
        }

        TimeSheet::create($data);

        return redirect()->route('timesheet.index')
            ->with('success', 'TimeSheet créé avec succès');
    }

    public function show(TimeSheet $timesheet)
    {
        if (!$this->isAdmin()) {
            $annonceur = $this->getAnnonceurConnecte();
            if ($timesheet->annonceur_id != $annonceur->id) {
                abort(403);
            }
        }

        $timesheet->load(['annonceur', 'servicePublicitaire', 'panneauPublicitaire']);

        return view('admin.timesheet.show', compact('timesheet'));
    }

    public function edit(TimeSheet $timesheet)
    {
        if (!$this->isAdmin()) {
            $annonceur = $this->getAnnonceurConnecte();
            if ($timesheet->annonceur_id != $annonceur->id) {
                abort(403);
            }
        }

        $panneaux = PanneauPublicitaire::all();

        $services = ServicePublicitaire::all(); 

        if ($this->isAdmin()) {
            $annonceurs = Annonceur::all();
        } else {
            $annonceur  = $this->getAnnonceurConnecte();
            $annonceurs = collect([$annonceur]);
        }

        return view('admin.timesheet.edit', compact(
            'timesheet', 'annonceurs', 'services', 'panneaux'
        ));
    }

    public function update(Request $request, TimeSheet $timesheet)
    {
        $data = $request->validate([
            'datedebut'               => 'required|date',
            'datefin'                 => 'required|date|after_or_equal:datedebut',
            'heuredebut'              => 'required',
            'heurefin'                => 'required',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
            'panneau_publicitaire_id' => 'required|exists:panneau_publicitaires,id',
            'annonceur_id'            => 'required|exists:annonceurs,id',
        ]);

        if (!$this->isAdmin()) {
            $annonceur = $this->getAnnonceurConnecte();

            if (!$annonceur) {
                abort(403, 'Aucun profil annonceur lié à ce compte.');
            }

            if ($timesheet->annonceur_id != $annonceur->id) {
                abort(403);
            }

            $data['annonceur_id'] = $annonceur->id;
        }

        $timesheet->update($data);

        return redirect()->route('timesheet.index')
            ->with('success', 'TimeSheet modifié avec succès');
    }

    public function destroy(TimeSheet $timesheet)
    {
        if (!$this->isAdmin()) {
            $annonceur = $this->getAnnonceurConnecte();
            if ($timesheet->annonceur_id != $annonceur->id) {
                abort(403);
            }
        }

        $timesheet->delete();

        return redirect()->route('timesheet.index')
            ->with('success', 'TimeSheet supprimé avec succès');
    }

    public function byAnnonceur($id)
    {
        if (!$this->isAdmin()) {
            abort(403);
        }

        $annonceur  = Annonceur::findOrFail($id);
        $timeSheets = TimeSheet::with(['servicePublicitaire', 'panneauPublicitaire'])
            ->where('annonceur_id', $annonceur->id)
            ->get();

        return view('admin.timesheet.index', compact('timeSheets', 'annonceur'));
    }
}