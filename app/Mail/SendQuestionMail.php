<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendQuestionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $senderName;
    public $senderEmail;
    public $senderMessage;

    /**
     * Create a new message instance.
     */
    public function __construct(string $name, string $email, string $message)
    {
        $this->senderName = $name;
        $this->senderEmail = $email;
        $this->senderMessage = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pertanyaan Baru dari Peserta JKB Festival',
            replyTo: [$this->senderEmail],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.question',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
