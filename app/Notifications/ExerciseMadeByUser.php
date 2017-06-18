<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExerciseMadeByUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($exercise, $practitioner, $user)
    {
        $this->exercise = $exercise;
        $this->practitioner = $practitioner;
        $this->user = $user;
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

      $questionLines = "";
      foreach ($this->exercise->questions as $key => $question) {

        $key = $key + 1;
        $questionLines = $questionLines . "Vraag " . $key . ": " . $question->question . "\n" . "Gegeven antwoord: " . $question->answerGiven . "\n \n \n";
      }


        return (new MailMessage)
                    ->subject('Client ' . $this->user->firstname . ' ' . $this->user->lastname . 'heeft oefening met code: ' . $this->exercise->code . ' opgelost.')
                    ->greeting('Hallo, ' . $this->practitioner->firstname)
                    ->line('Er is een nieuwe oefening opgelost door ' . $this->user->firstname . ' ' . $this->user->lastname)
                    ->line('Deze bevatte subcategorie:  ' . $this->exercise->subcategory->name)
                    ->line('')
                    ->line('Titel van oefening: ' . $this->exercise->title)
                    ->line('Beschrijving: ' . $this->exercise->description)
                    ->line('')
                    ->line('')

                    ->line(nl2br($questionLines))

                    ->line('')
                    ->line('')
                    ->line('');
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
            'message' => $this->user->firstname . ' ' . $this->user->lastname . ' heeft oefening met code: ' .   $this->exercise->code . ' opgelost.',
            'action' => 'Kijk uw opgegeven email na voor haar/zijn antwoorden',
            'type' => 'exercise-made'
          ];

    }
}
