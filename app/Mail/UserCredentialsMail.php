<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $loginUrl = null,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Seu acesso administrativo - ' . getSettings('site_name_short'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user-credentials',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'loginUrl' => $this->loginUrl,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
