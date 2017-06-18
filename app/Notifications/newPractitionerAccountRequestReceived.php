<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newPractitionerAccountRequestReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($requester, $practiceArray)
    {
        $this->requester = $requester;
        $this->practice = $practiceArray;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toMail($notifiable)
     {
       return (new MailMessage)
       ->subject('Jouw registratie-aanvraag bij SOLVR is goed gelukt!')
       ->greeting('Hallo, '. $this->requester->firstname)
       ->line('Je aanvraag om je bij ' .   $this->practice['name'] . ' te registreren is goed ontvangen.')
       ->line('De beheerder van deze praktijk zal nu je aanvraag nakijken. Zolang dit niet gebeurd is, kan je nog niet gebruik maken van het platform.')
       ->line('Zodra je account werd geaccepteerd of geweigerd, word je op de hoogte gebracht via email.')

       ->line('Bedankt voor je geduld!');
     }

     /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
