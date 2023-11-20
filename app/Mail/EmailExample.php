<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class EmailExample extends Mailable
{
    public function build()
    {
        return $this->view('emails.example_email')
            ->subject('ExamplesSubject of the email');
    }
}