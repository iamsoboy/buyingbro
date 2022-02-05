<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\UserDeposit;
use App\User;

class depositSuccessful extends Notification
{
    use Queueable;

    public $deposit;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deposit)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $deposit = $this->deposit;

        $user = User::where('id', $deposit->user_id)->first();

        return (new MailMessage)->markdown('emails.transactions.depositSuccessful', ['deposit' => $deposit, 'user'=> $user]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
