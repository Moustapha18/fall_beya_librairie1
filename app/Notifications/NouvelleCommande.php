<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NouvelleCommande extends Notification
{
    use Queueable;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('📥 Nouvelle commande reçue')
            ->greeting('Bonjour Gestionnaire,')
            ->line('📦 Une nouvelle commande vient d’être passée.')
            ->line('🧑 Client : **' . $this->commande->user->name . '**')
            ->line('💵 Montant total : **' . number_format($this->commande->total, 2, ',', ' ') . ' F CFA**')
            ->action('🛠 Gérer la commande', route('commandes.show', $this->commande->id))
            ->line('Merci de traiter cette commande rapidement.');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
