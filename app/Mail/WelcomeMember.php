<?php

/**
 * Putting this here to help remind you where this came from.
 *
 * I'll get back to improving this and adding more as time permits
 * if you need some help feel free to drop me a line.
 *
 * * Twenty-Years Experience
 * * PHP, JavaScript, Laravel, MySQL, Java, Python and so many more!
 *
 *
 * @author  Simple-Pleb <plebeian.tribune@protonmail.com>
 * @website https://www.simple-pleb.com
 * @source https://github.com/simplepleb/laravel-email-templates
 *
 * @license Free to do as you please
 *
 * @since 1.0
 *
 */

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Repositories\UsersRepository;

class WelcomeMember extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $options;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $options = null)
    {
        $this->_userRepository      = new UsersRepository;

        $this->member = $this->_userRepository->getById($user);
        $this->options = $options;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Selamat datang ' . $this->member->user_name . " - " . config('app.name'))
            ->view('emails.welcome_member')
            ->with([
                'user_kta'     => $this->member->user_kta,
                'user_name'     => $this->member->user_name,
                'email'         => $this->member->user_email,
                'user_phone'    => $this->member->user_phone,
                'username'      => $this->member->user_username,
                'password'      => $this->options,
                'created_at'    => date('d F Y H:m:s', strtotime($this->member->updated_at)),
            ]);
    }
}
