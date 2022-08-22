<?php

namespace App\Jobs;

use App\Mail\ScreeningInsertionEmailQueueSend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;




class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    protected $location;
    public $timeout = 120; // 2 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $location)
    {
        //
        $this->details = $details;
        $this->location = $location;
        //dd($this->details);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        if ($this->location == 'status')
        {
            /*Mail::send('emails.email_screening_status', [], function($message) {
                $message->to($this->details['to']);
                //$message->cc($details['cc']);
                $message->subject($this->details['subject']);
                //$message->subject($details['message']);
            });*/
            $email_status = new ScreeningInsertionEmailQueueSend($this->details, $this->location);
            Mail::to($this->details['to'])->send($email_status);
        }
        elseif ($this->location == 'add')
        {
            $email = new ScreeningInsertionEmailQueueSend($this->details, $this->location);
            Mail::to($this->details['to'])->send($email);

        }
        elseif ($this->location == 'comment')
        {
            /*Mail::send('emails.email_insert_comment', [], function($message) {
                $message->to($this->details['to']);
                //$message->cc($details['cc']);
                $message->subject($this->details['subject']);
                //$message->subject($details['message']);
            });*/
            $email_comment = new ScreeningInsertionEmailQueueSend($this->details, $this->location);
            Mail::to($this->details['to'])->send($email_comment);
        }
        elseif ($this->location == 'leaver')
        {
            $email_comment = new ScreeningInsertionEmailQueueSend($this->details, $this->location);
            Mail::to($this->details['to'])->send($email_comment);
        }


    }
}
