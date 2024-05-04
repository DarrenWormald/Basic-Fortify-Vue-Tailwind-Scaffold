<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfilePhoto;
use App\Actions\Contracts\UpdatesUserProfilePhoto;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::Class,
        );

        
        $this->app->singleton(
            \Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse::class,
            \App\Http\Responses\ProfileInformationUpdatedResponse::Class,
        );

        $this->app->singleton(
            \Laravel\Fortify\Contracts\PasswordUpdateResponse::class,
            \App\Http\Responses\PasswordUpdateResponse::Class,
        );

        $this->app->singleton(
            \Laravel\Fortify\Contracts\PasswordConfirmedResponse::class,
            \App\Http\Responses\PasswordConfirmedResponse::Class,
        );

        $this->app->singleton(
            \Laravel\Fortify\Contracts\EmailVerificationNotificationSentResponse::class,
            \App\Http\Responses\EmailVerificationNotificationSentResponse::class
        );

        $this->app->singleton(
            \Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse::class,
            \App\Http\Responses\SuccessfulPasswordResetLinkRequestResponse::class
        );
        $this->app->singleton(
            \Laravel\Fortify\Contracts\PasswordResetResponse::class,
            \App\Http\Responses\PasswordResetResponse::class
        );


        $this->app->singleton(
            UpdatesUserProfilePhoto::class,
            UpdateUserProfilePhoto::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::confirmPasswordView(function () {
            //return view inertia render etc for a page
            return inertia()->modal('Auth/ConfirmPassword')->baseRoute('home');
        });

        Fortify::twoFactorChallengeView(function () {
            //return view inertia render etc for a page
            return inertia()->modal('Auth/TwoFactorChallenge')->baseRoute('home');
        });

        Fortify::verifyEmailView(function () {
            //return view inertia render etc for a page
            return inertia()->modal('Auth/VerifyEmail')->baseRoute('home');
        });
    }


}
