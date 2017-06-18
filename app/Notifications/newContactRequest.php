<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newContactRequest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($practitioner, $practice, $requester)
    {
        $this->practitioner = $practitioner;
        $this->practice = $practice;
        $this->requester = $requester;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      if (isset($this->requester['telephone'])) {
        return (new MailMessage)
                    ->subject('Nieuwe contactaanvraag van' . $this->requester['firstname'])
                    ->greeting('Hallo, ' . $this->practitioner['firstname'])
                    ->line('Er is een nieuwe contact aanvraag van ' . $this->requester['firstname'] . ' ' . $this->requester['lastname'])
                    ->line('Zijn/haar bericht:')
                    ->line($this->requester['message'])
                    ->line('U kan deze persoon bereiken op emailadres:' . $this->requester['email'] . ' of op telefoonnummer: ' . $this->requester['telephone'])
                    ->line('Wij danken u voor het gebruik van Solvr!');
      }
      else {
        return (new MailMessage)
                    ->subject('Nieuwe contactaanvraag van' . $this->requester['firstname'])
                    ->greeting('Hallo, ' . $this->practitioner['firstname'])
                    ->line('Er is een nieuwe contact aanvraag van ' . $this->requester['firstname'] . ' ' . $this->requester['lastname'])
                    ->line('Zijn/haar bericht:')
                    ->line($this->requester['message'])
                    ->line('U kan deze persoon bereiken op emailadres:' . $this->requester['email'] . '.')
                    ->line('Wij danken u voor het gebruik van Solvr!');
      }

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
          'message' => 'Er is een nieuwe contactaanvraag van ' . $this->requester['firstname'] . ' ' . $this->requester['lastname'],
          'action' => 'Kijk uw opgegeven email na.',
          'type' => 'contact'
        ];
    }
}
