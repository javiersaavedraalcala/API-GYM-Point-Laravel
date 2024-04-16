<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient = '';
    public $clientName = '';
    public $membershipStart = '';
    public $membershipEnd = '';
    public $plan = '';

    /**
     * Constructor function for the class.
     *
     * This function is automatically called when creating a new instance of the class.
     * It sets the initial values for the properties of the object.
     *
     * @param string $to The recipient email address.
     * @param string $clientName The name of the client.
     * @param DateTime $membershipStart The start date of the membership.
     * @param DateTime $membershipEnd The end date of the membership.
     * @param string $plan The membership plan.
     */
    public function __construct(string $recipient, string $clientName, string $membershipStart, string $membershipEnd, string $plan)
    {
        $this->recipient = $recipient;
        $this->clientName = $clientName;
        $this->membershipStart = $membershipStart;
        $this->membershipEnd = $membershipEnd;
        $this->membershipEnd = $membershipEnd;
        $this->plan = $plan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'gympoint@laravel.com',
            to: $this->recipient,
            subject: 'Welcome GYM Point',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.welcome_client',
            with: [
                'clientName' => $this->clientName,
                'membershipStart' => $this->membershipStart,
                'membershipEnd' => $this->membershipEnd,
                'plan' => $this->plan
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
