<?php

use App\Mail\EmailExample;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $userEmail = 'user@example.com';

        // Default smtp mailer
        Mail::to($userEmail)->send(new EmailExample());

        // We can also use other smtp mailer configs too
        Mail::mailer('smtp_other')->to($userEmail)->send(new EmailExample());

        return 'Email sent successfully!';
    }
}