<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class FundRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected  $mailContent;
    public function __construct($content, $project)
    {
        $this->mailContent = $content;
        $this->subject= $project ? $project->ProjectName : 'Not Set'.' ~ Project Expense Approval';
        $this->from(Auth::guest() ? 'no-reply@freightwell.com' : Auth::user()->email, ucwords(Auth::guest() ? $this->subject : Auth::user()->name));

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.fund.request',['data'=>$this->mailContent]);
    }
}
