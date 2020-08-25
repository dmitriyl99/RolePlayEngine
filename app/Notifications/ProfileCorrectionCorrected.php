<?php

namespace App\Notifications;

use App\ProfileCorrection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProfileCorrectionCorrected extends Notification
{
    use Queueable;

    protected ProfileCorrection $correction;

    /**
     * Create a new notification instance.
     *
     * @param ProfileCorrection $correction
     */
    public function __construct(ProfileCorrection $correction)
    {
        $this->correction = $correction;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'correction' => $this->correction,
            'url' => route('profiles.show', $this->correction->profile->id)
        ];
    }
}
