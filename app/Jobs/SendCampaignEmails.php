<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Mail\Mailer;

class SendCampaignEmails extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $urlhelper, $mailer, $view,$subject,$receiverEmail,$senderEmail,$senderName=null,$name=null;

    /**
     * SendCampaignEmails constructor.
     * @param $view
     * @param $subject
     * @param $receiverEmail
     * @param $senderEmail
     * @param null $senderName
     * @param null $name
     */
    public function __construct($view, $subject, $receiverEmail, $senderEmail, $senderName=null, $name=null)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->receiverEmail = $receiverEmail;
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
        $this->name = $name;
    }

    /**
     * @param UrlGenerator $urlhelper
     * @param Mailer $mailer
     */
    public function handle(UrlGenerator $urlhelper, Mailer $mailer)
    {
        $receiverEmail = $this->receiverEmail;
        $subject = $this->subject;
        $senderEmail = $this->senderEmail;
        $senderName = $this->senderName;
        $urlhelper->forceRootUrl(config('app.url'));
        $mailer->queue($this->view, ['name'=>$this->name], function ($m) use ($receiverEmail, $subject, $senderEmail, $senderName) {
            $m->to($receiverEmail)->subject($subject);
            $m->from($senderEmail, $senderName);
        });
    }
}
