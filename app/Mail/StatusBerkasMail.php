<?php

namespace App\Mail;

use App\Models\PendaftaranKamar;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusBerkasMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(PendaftaranKamar $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Status Pendaftaran Kamar Asrama Anda')
            ->view('admin.dataBerkas.emailStatusBerkas');
    }
}
