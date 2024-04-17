<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Liber - Verify Email Address')
                ->markdown('mails.verifyMail', ['url' => $url]);
                /*
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
                */
        });

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return route('password.reset', ['token' => $token]);
            // 'http://127.0.0.1:8000/reset-password/'.$token;
        });

        /*
        ResetPassword::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Reset Password Notification AA')
                ->line('You are receiving this email because we received a password reset request for your account.')
                ->action('Reset Password', $url);
            //->markdown('mails.resetPasswordConfirmation', ['url' => $url]);

        });
        */

    }
}
