<?php

namespace Database\Seeders;

use App\Models\Livre;
use Illuminate\Database\Seeder;

class LivreSeeder extends Seeder
{
    public function run(): void
    {
        $livres = [
            [
                'titre' => 'Le Petit Prince',
                'auteur' => 'Antoine de Saint-Exupéry',
                'categorie' => 'Roman',
                'description' => 'Un conte poétique et philosophique racontant les aventures d’un petit prince venu d’une autre planète.',
                'prix' => 12.99,
                'stock' => 10,
            ],
            [
                'titre' => 'L’Étranger',
                'auteur' => 'Albert Camus',
                'categorie' => 'Roman',
                'description' => 'L’histoire d’un homme détaché du monde confronté à l’absurdité de l’existence.',
                'prix' => 10.50,
                'stock' => 7,
            ],
            [
                'titre' => 'Les Misérables',
                'auteur' => 'Victor Hugo',
                'categorie' => 'Classique',
                'description' => 'Une épopée bouleversante sur la justice, la rédemption et la misère sociale en France au XIXe siècle.',
                'prix' => 14.00,
                'stock' => 5,
            ],
            [
                'titre' => 'Madame Bovary',
                'auteur' => 'Gustave Flaubert',
                'categorie' => 'Roman',
                'description' => 'Le portrait poignant d’une femme en quête d’amour et d’évasion dans la société bourgeoise.',
                'prix' => 11.75,
                'stock' => 8,
            ],
        ];

        foreach ($livres as $livre) {
            Livre::create($livre);
        }
    }
}
