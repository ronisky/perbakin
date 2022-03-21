<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('pengirim@perbakinkabbandung.or.id')
        //     ->view('emailku')
        //     ->with(
        //         [
        //             'nama' => 'Diki Alfarabi Hadi',
        //             'website' => 'www.perbakinkabbandung.or.id',
        //         ]
        //     );

        return $this->from('pengirim@perbakinkabbandung.or.id')
            ->view('emails/sample-mail')
            ->with(
                [
                    'nama' => 'Roni Setiawan',
                    'website' => 'www.perbakinkabbandung.or.id',
                ]
            )
            ->attach(public_path('/img') . '/logo_perbakin.png', [
                'as' => 'logo_perbakin.png',
                'mime' => 'image/png',
            ]);
    }
}
