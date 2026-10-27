<?php
  
namespace App\Notifications;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
  
class EmailNotification extends Notification
{
    use Queueable;
  
    private $messages;
  
    /**
     * Create a new notification instance.
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }
  
    /**
     * Get the notification's delivery channels.
     *
     * @return array

     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }
  
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->messages['subject'])
                    ->greeting($this->messages['greeting'])
                    ->line($this->messages['body'])
                    ->line($this->messages['thanks']);
    }
  
    /**
     * Get the array representation of the notification.
     *
     * @return array

     */
    public function toArray(object $notifiable): array
    {
        return [
              
        ];
    }
}