<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuestionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $message;
    protected $instructorName;
    protected $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $message, $instructorName, $title)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->instructorName = $instructorName;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->email, $this->name)
            ->markdown('emails.question')
            ->with([
                'name' => $this->name,
                'body' => $this->message,
                'email' => $this->email,
                'instructorName' => $this->instructorName,
                'title' => $this->title,
            ]);
    }
}