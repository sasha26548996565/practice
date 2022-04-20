<?php

declare(strict_types=1);

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function build()
    {
        return $this->markdown('mail.user.password');
    }
}
