<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $senderEmail = !empty($this->data['email']) ? $this->data['email'] : config('mail.from.address', 'kerollossami@gmail.com');
        $senderName = !empty($this->data['name']) ? $this->data['name'] : 'Portfolio Client';

        return $this->from($senderEmail, $senderName)
            ->replyTo($senderEmail, $senderName)
            ->subject('⚡ [' . $senderEmail . '] ' . ($this->data['subject'] ?? 'New Verified Inquiry') . ' — ' . $senderName)
            ->view('emails.contact')
            ->with('data', $this->data);
    }
}
