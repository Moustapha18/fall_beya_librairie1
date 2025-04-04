<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivreTest extends TestCase
{
    use RefreshDatabase;

    public function test_gestionnaire_peut_creer_un_livre()
    {
        $user = User::factory()->create(['role' => 'gestionnaire']);

        $response = $this->actingAs($user)->post('/livres', [
            'titre' => 'Nouveau Livre',
            'auteur' => 'Auteur Test',
            'categorie' => 'Roman',
            'prix' => 19.99,
            'stock' => 10,
        ]);

        $response->assertRedirect('/livres');
        $this->assertDatabaseHas('livres', ['titre' => 'Nouveau Livre']);
    }
}
