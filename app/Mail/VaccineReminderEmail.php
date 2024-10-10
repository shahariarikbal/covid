<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VaccineReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $vaccination;

    /**
     * Create a new message instance.
     */
    public function __construct($vaccination)
    {
        $this->vaccination = $vaccination;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vaccine Reminder Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Vaccination Reminder')
            ->view('emails.vaccine-reminder')->with('vaccination', $this->vaccination);
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
