<?php

namespace App\Mail;

use App\Models\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailable\Envelope;
use Illuminate\Mail\Mailable\Content;
use Illuminate\Queue\SerializesModels;

class phpmail extends Mailable
{
    use Queueable, SerializesModels;

    // public $job;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Jobs $job)
    {
        $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Job Posted')
        ->from('info@phpmail.com')  
        ->markdown('emails.phpmail');
    }
}
