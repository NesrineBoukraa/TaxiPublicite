<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimeSheet;
use App\Models\ServicePublicitaire;
use App\Models\PanneauPublicitaire;
use Illuminate\Http\Request;

class TimeSheetController extends Controller
{
    public function index()
    {
        $timeSheets = TimeSheet::with(['servicePublicitaire', 'panneauPublicitaire'])->get();
        return view('admin.timesheet.index', compact('timeSheets'));
    }

    public function create()
    {
        $services = ServicePublicitaire::all();
        $panneaux = PanneauPublicitaire::all();
        return view('admin.timesheet.create', compact('services', 'panneaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'datedebut'               => 'required|date',
            'datefin'                 => 'required|date|after_or_equal:datedebut',
            'heuredebut'              => 'required|date_format:H:i',
            'heurefin'                => 'required|date_format:H:i|after:heuredebut',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
            'panneau_publicitaire_id' => 'required|exists:panneau_publicitaires,id',
        ], [
            'datedebut.required'               => 'La date de début est obligatoire',
            'datefin.required'                 => 'La date de fin est obligatoire',
            'datefin.after_or_equal'           => 'La date de fin doit être après la date de début',
            'heuredebut.required'              => "L'heure de début est obligatoire",
            'heuredebut.date_format'           => "L'heure de début doit être au format HH:MM",
            'heurefin.required'                => "L'heure de fin est obligatoire",
            'heurefin.date_format'             => "L'heure de fin doit être au format HH:MM",
            'heurefin.after'                   => "L'heure de fin doit être après l'heure de début",
            'service_publicitaire_id.required' => 'Le service est obligatoire',
            'service_publicitaire_id.exists'   => "Le service sélectionné n'existe pas",
            'panneau_publicitaire_id.required' => 'Le panneau est obligatoire',
            'panneau_publicitaire_id.exists'   => "Le panneau sélectionné n'existe pas",
        ]);

        TimeSheet::create($request->all());
        return redirect()->route('timesheet.index')
                         ->with('success', 'TimeSheet créé avec succès');
    }

    public function show(TimeSheet $timesheet)
    {
        $timesheet->load(['servicePublicitaire', 'panneauPublicitaire']);
        return view('admin.timesheet.show', compact('timesheet'));
    }

    public function edit(TimeSheet $timesheet)
    {
        $services = ServicePublicitaire::all();
        $panneaux = PanneauPublicitaire::all();
        return view('admin.timesheet.edit', compact('timesheet', 'services', 'panneaux'));
    }

    public function update(Request $request, TimeSheet $timesheet)
    {
        $request->validate([
            'datedebut'               => 'required|date',
            'datefin'                 => 'required|date|after_or_equal:datedebut',
            'heuredebut'              => 'required|date_format:H:i',
            'heurefin'                => 'required|date_format:H:i|after:heuredebut',
            'service_publicitaire_id' => 'required|exists:service_publicitaires,id',
            'panneau_publicitaire_id' => 'required|exists:panneau_publicitaires,id',
        ], [
            'datedebut.required'               => 'La date de début est obligatoire',
            'datefin.required'                 => 'La date de fin est obligatoire',
            'datefin.after_or_equal'           => 'La date de fin doit être après la date de début',
            'heuredebut.required'              => "L'heure de début est obligatoire",
            'heurefin.required'                => "L'heure de fin est obligatoire",
            'heurefin.after'                   => "L'heure de fin doit être après l'heure de début",
            'service_publicitaire_id.required' => 'Le service est obligatoire',
            'panneau_publicitaire_id.required' => 'Le panneau est obligatoire',
        ]);

        $timesheet->update($request->all());
        return redirect()->route('timesheet.index')
                         ->with('success', 'TimeSheet modifié avec succès');
    }

    public function destroy(TimeSheet $timesheet)
    {
        $timesheet->delete();
        return redirect()->route('timesheet.index')
                         ->with('success', 'TimeSheet supprimé avec succès');
    }

   
}