<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Foundation\Auth\User;

class kycSubmitted extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $user = $this->user;
        
        return (new MailMessage)
                    ->subject('Identity Verification Request')
                    ->greeting('Hello '. $user->name.'!')
                    ->line("We have received your Identity Verification Request. Feel free to continue play in our site during this verification process.")
                    ->line("Once Verification is complete you will be notify via email. Also you can see your verification status in your dashboard. To login your account click login now button below. ")
                    ->action('Login Now', route('login'))
                    ->line('Thank you for using our website! If you face any problem feel free to contact us anytime.');
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
