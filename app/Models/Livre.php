<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{

    public function commandes() {
        return $this->belongsToMany(Commande::class, 'commande_livres');
    }
    use HasFactory;

    protected $fillable = [
        'titre',
        'auteur',
        'categorie',
        'prix',
        'description',
        'stock',
        'image'
    ];
}
