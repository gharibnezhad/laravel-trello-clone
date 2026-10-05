<?php

namespace Web\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Web\User\Models\EmailChange;

class EmailChangeSecurityNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        protected EmailChange $emailChange,
        protected string $approveToken,
        protected string $denyToken
    )
    {
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
        $approveUrl = route('email-change.approve', [
            'token' => $this->approveToken,
        ]);

        $denyUrl = route('email-change.deny', [
            'token' => $this->denyToken,
        ]);

        return (new MailMessage)
            ->subject('Security Alert: Email Change Requested')
            ->line('A request was made to change your email address.')
            ->line('New email: ' . $this->emailChange->new_email)
            ->action('Approve Email Change', $approveUrl)
            ->line('[Cancel Email Change](' . $denyUrl . ')')
            ->line('This link will expire in 30 minutes.');
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
