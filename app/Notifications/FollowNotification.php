<?php

namespace App\Notifications;

use App\Mail\GreetingMessage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected User $user, protected User $follower) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        //$notifiable => the user where will recieve the notifiaction
        $via = ['database', 'mail'];
        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage | GreetingMessage
    {

        // return (new GreetingMessage($notifiable->name))->to($notifiable->email);

        return (new MailMessage) 
            ->subject('New Follower')
            // ->greeting('Hi' . $notifiable->name . ',')
            // ->line("{$this->follower->name} started following you.")
            // ->action('View Profile', route('users.profile', $this->follower->username))
            // ->line('Thank you for using our application!');
            ->view('mails.follow', [
                'user' => $notifiable,
                'follower' => $this->follower
            ]);
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'New fllower',
            'body' => "{$this->follower->name} started following you.",
            'link' => route('users.profile', $this->follower->username),
            'meta' => [
                'follower_id' => $this->follower->id,
                "follower_avatar" => $this->follower->avatar
            ]
        ];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // for database or broadcast
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
