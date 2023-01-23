<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ImportStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var App\Model\User
     */
    public $user;

    /**
     * Defines the status of the import.
     *
     * @var App\Model\User
     */
    public $importStatus;

    /**
     * Create a new message instance.
     * @param App\Model\User $user
     * @param bool $importStatus
     *
     * @return void
     */
    public function __construct(User $user, $importStatus)
    {
        $this->user = $user;
        $this->importStatus = ($importStatus) ? "Success" : "Failed";
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Your Import has been '. $this->importStatus,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.import_status',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
