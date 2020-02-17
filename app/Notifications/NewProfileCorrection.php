<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewProfileCorrection extends Notification
{
    use Queueable;

    /**
     * @var \App\ProfileCorrection
     */
    private $newProfileCorrection;

    /**
     * Create a new notification instance.
     *
     * @param \App\ProfileCorrection $newProfileCorrection
     * @return void
     */
    public function __construct($newProfileCorrection)
    {
        $this->newProfileCorrection = $newProfileCorrection;
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
            'game_master' => $this->newProfileCorrection->owner->nickname,
            'hero_name' => $this->newProfileCorrection->profile->hero->getName(),
            'url' => route('profile', $this->newProfileCorrection->profile->id)
        ];
    }
}
