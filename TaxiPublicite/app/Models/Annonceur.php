<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Annonceur extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
    ];

    public function servicepublicitaires()
    {
        return $this->hasMany(ServicePublicitaire::class, 'annonceur_id', 'id');
    }


    public function dossierannonces()
    {
        return $this->hasMany(DossierAnnonce::class);
    }
    public function publications()
    {
        return $this->hasManyThrough(
            Publication::class,
            DossierAnnonce::class,
            'annonceur_id',
            'dossier_annonce_id',
            'id',
            'id'
        );
    }


    public function statutvalidations()
    {
        return $this->hasManyThrough(
            StatutValidation::class,
            DossierAnnonce::class,
            'annonceur_id',
            'dossier_annonce_id',
            'id',
            'id'
        );
    }
}
