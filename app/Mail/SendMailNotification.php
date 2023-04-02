<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendMailNotification extends Mailable
{

    public $userComment;
    public $commentContent;
    public $dateComment;
    public $linkPost;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($userComment, $commentContent, $dateComment, $linkPost)
    {
        //
        $this->userComment = $userComment;
        $this->commentContent = $commentContent;
        $this->dateComment = $dateComment;
        $this->linkPost = $linkPost;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('thanhhandgun5@gmail.com', 'Tin tức Phật giáo'),
            subject: $this->userComment . ' đã phản hồi bài viết hoặc bình luận của bạn',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'client.SendMailNotification',
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
