<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\RecomendationLetter\Repositories\RecomendationLetterRepository;

class LetterSubmission extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $options = null)
    {
        $this->_recomendationLetterRepository      = new RecomendationLetterRepository;

        $this->letter = $this->_recomendationLetterRepository->getByIdLetter($id);
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengajuan Surat Rekomendasi Baru' . " - " . config('app.name'))
            ->view('emails.letter_submission')
            ->with([
                'name'     => $this->letter->name,
                'no_kta'     => $this->letter->no_kta,
                'club'         => $this->letter->club,
                'letter_category_name'    => $this->letter->letter_category_name,
                'created_at'    => date('d F Y H:m:s', strtotime($this->letter->created_at)),
            ]);
    }
}
