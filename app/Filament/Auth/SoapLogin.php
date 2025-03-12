<?php

namespace App\Filament\Auth;

use App\Models\User;
use App\Services\Soap\EliecontService\LoginService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SoapLogin extends Login
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        $loginService = app(LoginService::class);

        $response = $loginService->loginRequest($data['email'], $data['password']);

        if (Str::isJson($response)) {

            $result = json_decode($response, true);

            if ($result['ReturnCode'] == 0 || $result['ReturnCode'] == 26) {

                if ($result['SYCONTCT_BLK_ACCESS'] == 'Y') {

                    $paragraph = "Your account has been blocked for the following reason: \n\n".$result['SYCONTCT_BLK_REASON']."\n\n";
                    $paragraph .= "Please contact Davidsons via email at \n\n";
                    $paragraph .= "forguns@davidsonsinc.com \n\n";
                    $paragraph .= "or call 1-800-367-4867 \n to have your account released for entry into the web's most powerful gun site.";
                    $formattedMessage = nl2br($paragraph);

                    $this->displayBlockedNotification('ACCOUNT BLOCKED', $formattedMessage);

                    return null;
                }

                $id = $result['SYCONTCT_ID'];

                if ($id != 0) {

                    $user = User::where('id', $id)->first();

                    if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
                        $this->throwFailureValidationException();

                    } else {
                        // authenticated user...
                        $user = Filament::auth()->user();

                        if (
                            ($user instanceof FilamentUser) &&
                            (! $user->canAccessPanel(Filament::getCurrentPanel()))
                        ) {
                            Filament::auth()->logout();

                            $this->throwFailureValidationException();
                        }

                        session()->regenerate();

                        return app(LoginResponse::class);
                    }

                } else {
                    $this->displayNotification('We are unable to process your request. Please try again.');
                }
            } else {

                if ($result['ReturnCode'] == 5) {

                    // "This email address is invalid."
                    throw ValidationException::withMessages([
                        'data.email' => __('filament-panels::pages/auth/login.messages.email'),
                    ]);
                }

                if ($result['ReturnCode'] == 33) {
                    // $returnMsg = preg_replace('/\d+\^\d+\^/', '', $result['ReturnMsg']);
                    // "Your password is invalid."
                    throw ValidationException::withMessages([
                        'data.password' => __('filament-panels::pages/auth/login.messages.password'),
                    ]);
                }
            }
        } else {
            $this->displayPersistentNotification('We are unable to process your request. Please try again.');

            // probably need to log the response, etc...
            return null;
        }

        $user = Filament::auth()->user();

        if (
            ($user instanceof FilamentUser) &&
            (! $user->canAccessPanel(Filament::getCurrentPanel()))
        ) {
            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

    protected function displayNotification(string $message): void
    {
        Notification::make()
            ->title($message)
            ->body(__('filament-panels::pages/auth/login.messages.email'))
            ->danger()
            ->send();
    }

    protected function displayPersistentNotification(string $message): void
    {
        Notification::make()
            ->title($message)
            ->body(__('filament-panels::pages/auth/login.messages.email'))
            ->danger()
            ->persistent()
            ->send();
    }

    protected function displayBlockedNotification(string $title, $body): void
    {
        Notification::make()
            ->title($title)
            ->body($body)
            ->danger()
            ->safeViews(true)
            ->persistent()
            ->send();
    }
}
