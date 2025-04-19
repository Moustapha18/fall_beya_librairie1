<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Commande;

class FactureEnvoyee extends Notification
{
    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $pdf = Pdf::loadView('commandes.facture', ['commande' => $this->commande]);

        $fileName = 'facture_commande_' . $this->commande->id . '.pdf';
        $pdfPath = storage_path('app/public/' . $fileName);
        file_put_contents($pdfPath, $pdf->output());

        return (new MailMessage)
            ->subject('📄 Votre facture pour la commande #' . $this->commande->id)
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Votre commande a été expédiée avec succès.')
            ->line('Vous trouverez ci-joint la facture correspondante.')
            ->attach($pdfPath)
            ->line('Merci pour votre confiance et à bientôt sur notre librairie !');
    }
}
