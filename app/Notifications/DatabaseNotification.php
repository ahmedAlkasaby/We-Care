<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DatabaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message_ar;
    protected $message_en;
    protected $url;
    protected $case_id;






    public function __construct($message_ar, $message_en, $url=null,$case_id=null)
    {
        $this->message_ar = $message_ar;
        $this->message_en = $message_en;
        $this->url = $url;
        $this->case_id = $case_id;

    }

    public function via($notifiable)
    {
        return ['database']; // Specify that the notification should be sent via the database
    }


    public function toArray(object $notifiable): array
    {
        return [
            'messages' => json_encode([
                'ar' => $this->message_ar,
                'en' => $this->message_en,
            ]),

            'url' => $this->url,
            'case_id' => $this->case_id,
        ];
    }
}
