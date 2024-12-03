<?php

namespace App\Mail;

use App\Models\OneTimeCode as OneTimeCodeModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OneTimeCode extends Mailable implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected OneTimeCodeModel $code) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your login code',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.login.passwordless-email',
            with: [
                'code' => $this->code->code,
            ]
        );

    }
}
