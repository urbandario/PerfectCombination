<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrainerApproved extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The user instance.
     *
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'PerfectCombination')
            ->subject('Trainer Request Approved!')
            ->markdown('emails.trainer_approved');
    }
}
