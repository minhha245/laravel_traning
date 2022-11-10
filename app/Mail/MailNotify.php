<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Employee;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('camgiacla10x@gmail.com')
            ->view('mails.mail-notify')
            ->subject('Welcome to the system!!!');
            rghhietrghojkewrgljk;fsgdljkmhnfg.,fdf_get_encoding(fdf_document)
            jhodfguij
    }
}
