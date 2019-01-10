<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    public $dataForm;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataForm)
    {
        $this->dataForm = $dataForm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->to('jaime.vendrame@gmail.com')
                ->subject($this->dataForm['subject'])
                ->view('mail.contact.contact');
    }
}
