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
    public function index()
    {

        $user = Auth::user();

        if ($user && strcasecmp($user->role, 'admin') == 0) {

            $timeSheets = TimeSheet::with([
                'annonceur',
                'servicePublicitaire',
                'panneauPublicitaire'
            ])->get();

        } else {

            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

            if (!$annonceur) {
                return view('admin.timesheet.index', [
                    'timeSheets' => collect()
                ]);
            }

            $timeSheets = TimeSheet::where('annonceur_id', $annonceur->id)
                ->with([
                    'servicePublicitaire',
                    'panneauPublicitaire'
                ])
                ->get();
        }

        return view('admin.timesheet.index', compact('timeSheets'));

    }

        public function create()
    {
        $user = Auth::user();

        $services = ServicePublicitaire::with('annonceur')->get();
        $panneaux = PanneauPublicitaire::all();

        if ($user && strcasecmp($user->role, 'admin') == 0) {
            $annonceurs = Annonceur::all();
        } else {
            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

            $annonceurs = $annonceur ? collect([$annonceur]) : collect();
        }

        return view('admin.timesheet.create', compact(
            'annonceurs',
            'services',
            'panneaux'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'datedebut'               => 'required|date',
            'datefin'                 => 'required|date|after_or_equal:datedebut',
            'heuredebut'              => 'required|date_format:H:i',
            'heurefin'                => 'required|date_format:H:i|after:heuredebut',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
            'panneau_publicitaire_id' => 'required|exists:panneau_publicitaires,id',
            'annonceur_id'            => 'required|exists:annonceurs,id',
        ], [
            'datedebut.required' => 'La date de début est obligatoire',
            'datefin.required' => 'La date de fin est obligatoire',
            'datefin.after_or_equal' => 'La date de fin doit être après la date de début',
            'heuredebut.required' => "L'heure de début est obligatoire",
            'heuredebut.date_format' => "L'heure de début doit être au format HH:MM",
            'heurefin.required' => "L'heure de fin est obligatoire",
            'heurefin.date_format' => "L'heure de fin doit être au format HH:MM",
            'heurefin.after' => "L'heure de fin doit être après l'heure de début",
            'service_publicitaire_id.required' => 'Le service est obligatoire',
            'panneau_publicitaire_id.required' => 'Le panneau est obligatoire',
            'annonceur_id.required' => 'L\'annonceur est obligatoire',
        ]);

        // Sécurité annonceur
        if ($user && strcasecmp($user->role, 'admin') == 0) {

            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

            if (!$annonceur) {
                return back()->withErrors([
                    'error' => 'Votre compte utilisateur n\'est pas lié à un profil annonceur.'
                ]);
            }

            // vérifier que l’annonceur connecté est bien celui utilisé
            if ((int) $data['annonceur_id'] !== (int) $annonceur->id) {
                abort(403, 'Action non autorisée.');
            }

            // vérifier que le service appartient bien à cet annonceur
            $service = ServicePublicitaire::findOrFail($data['service_publicitaire_id']);

            if ($service->annonceur_id !== $annonceur->id) {
                abort(403, 'Service non autorisé.');
            }
        }

        TimeSheet::create($data);

        return redirect()->route('timesheet.index')
            ->with('success', 'TimeSheet créé avec succès');
    }

    public function show(TimeSheet $timesheet)
    {
        $user = Auth::user();

        $timesheet->load([
            'annonceur',
            'servicePublicitaire',
            'panneauPublicitaire'
        ]);

        if ($user && strcasecmp($user->role, 'admin') == 0) {

            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

            if (!$annonceur) {
                abort(403, 'Action non autorisée.');
            }

            // accès uniquement à ses propres timesheets
            if ($timesheet->annonceur_id !== $annonceur->id) {
                abort(403, 'Action non autorisée.');
            }
        }

        return view('admin.timesheet.show', compact('timesheet'));
    }
    public function edit(TimeSheet $timesheet)
    {
        $user = Auth::user();

        $timesheet->load(['annonceur']);

        if ($user && strcasecmp($user->role, 'admin') == 0) {
            $annonceurs = Annonceur::all();
        } else {
            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();
            $annonceurs = $annonceur ? collect([$annonceur]) : collect();
        }

        $services = ServicePublicitaire::all();
        $panneaux = PanneauPublicitaire::all();

        return view('admin.timesheet.edit', compact(
            'timesheet',
            'annonceurs',
            'services',
            'panneaux'
        ));
    }

    public function update(Request $request, TimeSheet $timesheet)
    {
        $user = Auth::user();

        $timesheet->load(['annonceur', 'servicePublicitaire']);

        // sécurité accès
        if ($user && strcasecmp($user->role, 'admin') == 0) {

            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

            if (!$annonceur) {
                abort(403);
            }

            if ($timesheet->annonceur_id !== $annonceur->id) {
                abort(403);
            }
        }

        $data = $request->validate([
            'datedebut'               => 'required|date',
            'datefin'                 => 'required|date|after_or_equal:datedebut',
            'heuredebut'              => 'required|date_format:H:i',
            'heurefin'                => 'required|date_format:H:i|after:heuredebut',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
            'panneau_publicitaire_id' => 'required|exists:panneau_publicitaires,id',
            'annonceur_id'            => 'required|exists:annonceurs,id',
        ], [
            'datedebut.required' => 'La date de début est obligatoire',
            'datefin.required' => 'La date de fin est obligatoire',
            'datefin.after_or_equal' => 'La date de fin doit être après la date de début',
            'heuredebut.required' => "L'heure de début est obligatoire",
            'heurefin.required' => "L'heure de fin est obligatoire",
            'heurefin.after' => "L'heure de fin doit être après l'heure de début",
            'service_publicitaire_id.required' => 'Le service est obligatoire',
            'panneau_publicitaire_id.required' => 'Le panneau est obligatoire',
            'annonceur_id.required' => "L'annonceur est obligatoire",
        ]);

        // sécurité métier (non-admin)
        if ($user && strcasecmp($user->role, 'admin') == 0) {

            if ((int) $data['annonceur_id'] !== (int) $annonceur->id) {
                abort(403);
            }

            $service = ServicePublicitaire::findOrFail($data['service_publicitaire_id']);

            if ($service->annonceur_id !== $annonceur->id) {
                abort(403);
            }
        }

        $timesheet->update($data);

        return redirect()->route('timesheet.index')
            ->with('success', 'TimeSheet modifié avec succès');
    }

    public function destroy(TimeSheet $timesheet)
    {
        $user = Auth::user();

        $timesheet->load('annonceur');

        // 🔒 sécurité accès
        if ($user && strcasecmp($user->role, 'admin') == 0){

            $annonceur = Annonceur::where('admin_user_id', $user->id)->first();

            if (!$annonceur) {
                abort(403);
            }

            if ($timesheet->annonceur_id !== $annonceur->id) {
                abort(403);
            }
        }

        $timesheet->delete();

        return redirect()->route('timesheet.index')
            ->with('success', 'TimeSheet supprimé avec succès');
    }

    /**
     * Méthode spécifique pour l'Admin pour voir les TimeSheets d'un annonceur précis
     */
    public function byAnnonceur($id)
    {
        $user = Auth::user();

        // 🔒 sécurité admin uniquement
        if ($user && strcasecmp($user->role, 'admin') == 0) {
            abort(403);
        }

        $annonceur = Annonceur::findOrFail($id);

        $timeSheets = TimeSheet::with([
            'servicePublicitaire',
            'panneauPublicitaire'
        ])
            ->where('annonceur_id', $annonceur->id)
            ->get();

        return view('admin.timesheet.index', compact(
            'timeSheets',
            'annonceur'
        ));
    }
}
