<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;
    public $subjectText;

    public function __construct($lead, $subjectText = null)
    {
        $this->lead = $lead;
        $this->subjectText = $subjectText;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText ?? 'Novo contato recebido - ' . getSettings('site_name_short'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contato',
            with: [
                'lead' => $this->lead,        
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

