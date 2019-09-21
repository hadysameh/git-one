<?php

namespace App\Listeners;
use App\Mail\reservedMail;
use App\Events\SendMialEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
class SendMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param  SendMialEvent  $event
     * @return void
     */
    public function handle($event)
    {
        // $data=[$event->user->name,$event->seat_num];
        Mail::to($event->emailData[0]->email)->send(new reservedMail($event->emailData));
    }
}
