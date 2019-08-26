<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewProfile extends Notification
{
    use Queueable;

    /**
     * New profile
     *
     * @var \App\Profile
    */
    private $newProfile;

    /**
     * Create a new notification instance.
     *
     * @param \App\Profile $newProfile
     * @return void
     */
    public function __construct($newProfile)
    {
        $this->newProfile = $newProfile;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'user_nickname' => $this->newProfile->hero->user->nickname,
            'heroname' => $this->newProfile->hero->name,
            'hero_nickname' => $this->newProfile->hero->nickname,
            'url' => route('profile', $this->newProfile->id)
        ];
    }
}
