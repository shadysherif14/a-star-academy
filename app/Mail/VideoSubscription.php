<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VideoSubscription extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $video, $name, $price,  $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $video, $price, $name, $email)
    {
        $this->user = $user;
        $this->video = $video;
        $this->name = $name;
        $this->price = $price;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->email)
            ->markdown('emails.videos.subscription')
            ->with([
                'video' => $this->video,
                'user' => $this->user,
                'name' => $this->name,
                'price' => $this->price,
            ]);
    }
}
