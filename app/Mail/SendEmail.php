<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendEmail extends Mailable
{   
    public $code = null;
    public $email = null;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($data,$data1)
    {
        $this->code = $data;
        $this->email = $data1;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('thanhhandgun5@gmail.com','Tin tức Phật giáo'),
            subject: 'Lấy lại mật khẩu',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'sendmail',
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
