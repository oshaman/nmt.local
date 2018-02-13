<?php

namespace Fresh\Nashemisto\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Informer extends Mailable
{
    use Queueable, SerializesModels;

    protected $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Новина від читача.";

        $content = view('emails.informer_content')->with('content', $this->content)->render();

        $email = $this->subject($subject)
            ->markdown('emails.informer')
            ->with('content', $content);

        // $attachments is an array with file paths of attachments
        if (!empty($this->content['attach'])) {
            foreach ($this->content['attach'] as $file) {
                $email->attach($file['path'], [
                    'as' => $file['file_name'],
                    'mime' => $file['mime']
                ]);
            }
        }

        return $email;
    }
}
