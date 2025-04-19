<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $livres = [
            [
                'titre' => 'L’aventurier du Sahel',
                'auteur' => 'Amadou Hampâté Bâ',
                'categorie' => 'Roman',
                'prix' => 12.50,
                'stock' => 10,
                'image' => 'placeholder.jpg'
            ],
            [
                'titre' => 'Les bouts de bois de Dieu',
                'auteur' => 'Sembène Ousmane',
                'categorie' => 'Historique',
                'prix' => 14.00,
                'stock' => 7,
                'image' => 'placeholder.jpg'
            ],
            [
                'titre' => 'Le vieux nègre et la médaille',
                'auteur' => 'Ferdinand Oyono',
                'categorie' => 'Politique',
                'prix' => 10.00,
                'stock' => 8,
                'image' => 'placeholder.jpg'
            ],
            [
                'titre' => 'Une si longue lettre',
                'auteur' => 'Mariama Bâ',
                'categorie' => 'Fiction',
                'prix' => 11.75,
                'stock' => 5,
                'image' => 'placeholder.jpg'
            ],
            [
                'titre' => 'L’appel des arènes',
                'auteur' => 'Aminata Sow Fall',
                'categorie' => 'Culturel',
                'prix' => 13.20,
                'stock' => 9,
                'image' => 'placeholder.jpg'
            ]
        ];
        //
    }
}
