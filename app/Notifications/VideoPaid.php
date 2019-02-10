<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VideoPaid extends Notification
{
    use Queueable;

    protected $video, $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $video)
    {
        $this->user = $user;

        $this->video = $video;
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
            ->greeting('Hello!')
            ->line("{$this->user->name} has been subscribed to {$this->video->title}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        $user = $this->user;

        $title = $this->video->title;

        $body = "
            <div class='media'>
                <img width='32' class='media-object' src='{$user->avatar}' alt=''>
                <div class='media-body'>
                    <span class='message'>
                        <strong> {$user->name} </strong> Subscribed for <strong> {$title} </strong>
                    </span>
                </div>
            </div>
        ";
        return [
            'user_id' => $user->id,
            'video_id' => $this->video->id,
            'body' => $body,
        ];
    }
}
