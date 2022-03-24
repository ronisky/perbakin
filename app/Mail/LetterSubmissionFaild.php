<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\RecomendationLetter\Repositories\RecomendationLetterRepository;

class LetterSubmissionFaild extends Mailable
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

        if ($options == 'admin') {
            if (str_contains($this->letter->admin_note, '|')) {
                $this->notes = str_replace('|', ', ', $this->letter->admin_note);
            } else {
                $this->notes =  $this->letter->admin_note;
            }
        } elseif ($options == 'sekum') {
            if (str_contains($this->letter->sekum_note, '|')) {
                $this->notes = str_replace('|', ', ', $this->letter->sekum_note);
            } else {
                $this->notes =  $this->letter->sekum_note;
            }
        } elseif ($options == 'ketua') {
            if (str_contains($this->letter->ketua_note, '|')) {
                $this->notes = str_replace('|', ', ', $this->letter->ketua_note);
            } else {
                $this->notes =  $this->letter->ketua_note;
            }
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Gagal, Pengajuan Surat Rekomendasi' . " - " . config('app.name'))
            ->view('emails.letter_submission_faild')
            ->with([
                'name'                  => $this->letter->name,
                'no_kta'                => $this->letter->no_kta,
                'club'                  => $this->letter->club,
                'letter_category_name'  => $this->letter->letter_category_name,
                'created_at'            => date('d F Y H:m:s', strtotime($this->letter->updated_at)),
                'notes'                 => $this->notes,
            ]);
    }
}
