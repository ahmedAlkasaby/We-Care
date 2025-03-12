<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class VerfyEmail extends Notification
{
    use Queueable;

    private $otp;
    private $email;
    public function __construct($email)
    {
        $this->otp=new Otp ;
        $this->email=$email;
    }


    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $code=$this->otp->generate($this->email,'numeric',4,10);
        return (new MailMessage)
                                ->greeting('Verfy Email')
                                ->line('code : '.$code->token)
                                ->line('thanks');
    }


}

