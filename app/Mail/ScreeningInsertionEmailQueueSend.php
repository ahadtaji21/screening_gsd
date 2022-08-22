<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScreeningInsertionEmailQueueSend extends Mailable
{
    use Queueable, SerializesModels;
    protected $location;
    protected $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $location)
    {
        //
        $this->details = $details;
        $this->location = $location;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->location == 'status')
        {
            return $this->subject($this->details['subject'])
                ->view('emails.email_screening_status')
                ->with('details', $this->details);
        }
        elseif ($this->location == 'add')
        {
            return $this->subject($this->details['subject'])
                ->view('emails.email_add_screening')
                ->with('details', $this->details);
        }
        elseif ($this->location == 'comment')
        {
            return $this->subject($this->details['subject'])
                ->view('emails.email_insert_comment')
                ->with('details', $this->details);
        }
        elseif ($this->location == 'leaver')
        {
            return $this->subject($this->details['subject'])
                ->view('emails.email_screening_leaver')
                ->with('details', $this->details);
        }
        
    }
}
