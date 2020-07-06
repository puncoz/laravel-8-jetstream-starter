<?php

namespace App\Core\Notifications;

use Closure;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class ResetPasswordNotification
 * @package App\Core\Notifications
 */
class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var Closure|null
     */
    protected static $toMailCallback;

    /**
     * @var string
     */
    protected $token;

    /**
     * ResetPasswordNotification constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param Closure $callback
     *
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        if ( static::$toMailCallback ) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $message = new MailMessage();
        $message->subject('Reset Password Notification');
        $message->greeting('Hello!');
        $message->line('You are receiving this email because we received a password reset request for your account.');
        $message->action('Reset Password', route('auth.password.reset', $this->token));
        $message->line('If you did not request a password reset, no further action is required.');

        return $message;
    }
}
