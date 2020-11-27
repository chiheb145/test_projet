<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * Elements de contact
     * @var array
     */
    public $contact;

    public function __construct(Array $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->from('chihebbouabid@gmail.com')
            ->view('emails.contact');
    }


}
