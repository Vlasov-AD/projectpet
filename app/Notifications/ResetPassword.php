<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends Notification
{
    use Queueable;
    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
                ->subject('Сброс пароля от учетной записи')
                ->line('Вы получили это письмо потому, что мы получили запрос на восстановление пароля от вашей учетной записи.')
                ->action('Сброс пароля', url("password/reset/{$this->token}?email={$notifiable->email}" ))
                ->line(Lang::get('Время жизни данной ссылки :count минут.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
                ->line('Если Вы не запрашивали восстановление пароля от Вашей учетной записи, то просто проигнорируйте данное сообщение.');
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
