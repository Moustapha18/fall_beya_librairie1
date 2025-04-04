<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmationCommande extends Notification
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
            ->subject('Confirmation de votre commande')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Votre commande n°' . $this->commande->id . ' a bien été enregistrée.')
            ->line('Montant total : ' . number_format($this->commande->total, 2, ',', ' ') . ' €')
            ->action('Voir mes commandes', url('/commande/mes'))
            ->line('Merci pour votre confiance et à bientôt !');
    }
}
