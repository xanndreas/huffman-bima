<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class HuffmanMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected array $data;

    public function __construct(array $data)
    {
        //
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            from: new Address($this->data['email'], $this->data['name']),
            subject: $this->data['subject'],
        );
    }

    public function content()
    {
        return new Content(
            view: 'content.admin.template.huffman-mail',
            with: [
                'contents' => $this->data['contents'],
            ],
        );
    }
}
