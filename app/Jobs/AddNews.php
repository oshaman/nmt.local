<?php

namespace Fresh\Nashemisto\Jobs;

use Fresh\Nashemisto\Mail\Informer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class AddNews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $content)
    {
        $this->email = $email;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = new Informer($this->content);
        Mail::to($this->email)->send($content);
    }
}
