<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class depositError extends Notification
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
        $this->deposit = $deposit;
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
        $user = Auth::user();
        
        return (new MailMessage)
                    ->error()
                    ->subject('Deposit Unsuccessful')
                    ->greeting("Sorry {$user->name}!")
                    ->line('Unfortunately, your deposit request of '. currency($deposit->amount) .' failed. Kindly try again!')
                    ->action('Deposit Now', route('deposit.create'))
                    ->line('Thank you! If your facing any issue feel free to contact us anytime.');
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
