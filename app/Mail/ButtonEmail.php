<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\URL;

class ButtonEmail extends Mailable
{
    use Queueable;

    public $order, $user;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $message, $user, $link, $btn)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->user = $user;
        $this->link = $link;
        $this->btn = $btn;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'academy.email_button',
            with:[
                'message' => $this->message,
                'customer' => $this->user,
                'button' => $this->link,
                'btn' => $this->btn,
            ]
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