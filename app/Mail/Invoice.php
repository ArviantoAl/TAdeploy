<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;
    public $data_ambil;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_ambil)
    {
        $this->data_ambil = $data_ambil;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data_ambil['email_cv'])
            ->view('dashboard.invoice');
    }
}
