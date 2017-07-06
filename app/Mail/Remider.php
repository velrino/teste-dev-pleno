<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Remider extends Mailable
{
    public $param;

    public function __construct($param)
    {
        $this->param = $param;
    }

    public function build()
    {
        return $this->from('hello@app.com', 'Your Application')
            ->subject('Convênia - Teste prático - DEV PHP PLENO')
            ->view('emails.send')
            ->with(['content' => $this->param]);
    }
}
