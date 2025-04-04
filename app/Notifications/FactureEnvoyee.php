<?php

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FactureEnvoyee extends Notification
{
    public function __construct(public $commande) {}

    public function via($notifiable) {
        return ['mail'];
    }

    public function toMail($notifiable) {
        $pdf = Pdf::loadView('commandes.facture', ['commande' => $this->commande]);
        $fileName = 'facture_'.$this->commande->id.'.pdf';
        $pdfPath = storage_path('app/public/'.$fileName);
        file_put_contents($pdfPath, $pdf->output());

        return (new MailMessage)
            ->subject('Votre facture pour la commande #'.$this->commande->id)
            ->line('Merci pour votre commande !')
            ->attach($pdfPath);
    }
}
