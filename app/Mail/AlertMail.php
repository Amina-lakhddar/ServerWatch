<?php
namespace App\Mail;

use App\Models\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    //  Alert li ghadi ntbatho f email
    public Alert $alert;

    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    //  Sujet dyal email
    public function envelope(): Envelope 
    {
        return new Envelope(
            subject: ' Alerte Critique — ' . $this->alert->message,
        );
    }
    //  Template dyal email
    public function content(): Content
    {
        return new Content(
            view: 'mail.alert',
            with: [
                'alert' => $this->alert,
            ]
        );
    }
}
