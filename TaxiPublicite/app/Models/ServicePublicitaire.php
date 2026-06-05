<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePublicitaire extends Model
{
    protected $fillable = [
        'nomservice',
        'description',
        'tarif',
        'dureejour',
        'actif',
        'annonceur_id',
    ];

    public function annonceur(): BelongsTo
    {
        return $this->belongsTo(Annonceur::class);
    }
    public function timeSheets()
    {
        return $this->hasMany(TimeSheet::class, 'service_publicitaire_id', 'id');
    }
    public function dossierAnnonces()
    {
        return $this->hasMany(DossierAnnonce::class);
    }
    public function publication()
    {
        return $this->hasManyThrough(
            Publication::class,
            DossierAnnonce::class,
            'service_publicitaire_id', 
            'dossier_annonce_id',      
            'id',
            'id'
        );
    }

    public function statutvalidation()
    {
        return $this->hasManyThrough(
            StatutValidation::class,
            DossierAnnonce::class,
            'service_publicitaire_id',
            'dossier_annonce_id',
            'id',
            'id'
        );
    }
    public function getProduitId(): ?int
    {
        return $this->produit_id;
    }

    protected $casts = [
        'actif' => 'boolean',
    ];
}
