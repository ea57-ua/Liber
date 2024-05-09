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
                ->greeting('Hello ' . $notifiable->name)
                ->line('Thank you for registering with Liber. We hope you are enjoying our platform.')
                ->action('Verify Email Address', $url)
                ->line('If you did not create an account with your email address, no further action is required.')
                ->salutation('Regards, Liber');
        });

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return route('password.reset', ['token' => $token]);
        });

    }
}
