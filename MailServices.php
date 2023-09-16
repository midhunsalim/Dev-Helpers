<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailServices implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = $this->data;
        $mailClass = 'App\\Mail\\' . $data['mailClass'];

        $email = new $mailClass((object)$data['mailData']);
        
        if($data['mailcc'])
        Mail::to(trim($data['mailTo']))->cc(trim($data['mailcc']))->send($email);
        else
        Mail::to(trim($data['mailTo']))->send($email);
    }
    
    /*
     function sendmail($mailData, $delay = 0)
    {
    $dispatch = dispatch((new \App\Jobs\MailServices([

        'mailClass' => $mailData['mailClass'],
        'mailTo' => $mailData['mailTo'],
        'mailcc' => isset($mailData['mailcc'])?$mailData['mailcc']:NULL ,
        'mailData' => $mailData['mailData']

    ]))->delay($delay)->onConnection('redis')->onQueue('high'));
   
    }
   
     
     */
}
