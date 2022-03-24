<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\RecomendationLetter\Repositories\RecomendationLetterRepository;

class LetterSubmissionSuccess extends Mailable
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

        $this->letter = $this->_recomendationLetterRepository->getById($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Berhasil, Pengajuan Surat Rekomendasi' . " - " . config('app.name'))
            ->view('emails.letter_submission_success')
            ->with([
                'name'     => $this->letter->name,
                'no_kta'     => $this->letter->no_kta,
                'club'         => $this->letter->club,
                'letter_category_name'    => $this->letter->letter_category_name,
                'created_at'    => date('d F Y H:m:s', strtotime($this->letter->updated_at)),
            ]);
    }
}
