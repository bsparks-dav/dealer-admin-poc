<?php

namespace App\Filament\Auth;

use App\Models\User;
use App\Services\Api\CustomerService;
use App\Services\Soap\EliecontService\LoginService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SoapLogin extends Login
{
    protected string $email = '';

    protected string $password = '';

    protected ?\Illuminate\Contracts\Auth\Authenticatable $user = null;

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        session(['soap_login' => $data]);

        $loginService = app(LoginService::class);

        $response = $loginService->loginRequest($data['email'], $data['password']);

        if (Str::isJson($response)) {

            $result = json_decode($response, true);

            \Log::info('Login response ReturnCode: ', [$result['ReturnCode']]);

            if ($result['ReturnCode'] == 5) {

                // "This email address is invalid"
                throw ValidationException::withMessages([
                    'data.email' => __('filament-panels::pages/auth/login.messages.email'),
                ]);
            }

            if ($result['ReturnCode'] == 33) {
                // "Your password is invalid."
                throw ValidationException::withMessages([
                    'data.password' => __('filament-panels::pages/auth/login.messages.password'),
                ]);
            }

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

                $CustomerService = app(CustomerService::class);

                $cust_no = $result['ContactRelationshipRecord']['ContactRelationshipRecord'][0]['SYCONREL_REF_ID'];

                \Log::info('cust_no from SOAP response: ', [$cust_no]);

                $ship_to_no = '';

                // get customer ship_to for other web services...
                if (strlen($cust_no) > 6) {
                    $cust_no = substr($cust_no, 0, 6);
                    $ship_to_no = substr($cust_no, 6);
                }

                session(['ship_to_no' => $ship_to_no]);

                session(['soap_cust_no' => $cust_no]);

                $CustomerService->setCustomerNumber($cust_no);

                $dealer_data = $CustomerService->getCustomer($cust_no);

                \Log::info('cus_name from dealer_data: ', [data_get($dealer_data, 'Customer.CUS_NAME')]);

                if (isset($dealer_data['Customer']['CUS_NAME']) && $dealer_data['Customer']['CUS_NAME']) {

                    $dealer_name = $dealer_data['Customer']['CUS_NAME'];

                    // create a user locally for session handling...
                    $this->user = User::firstOrCreate(
                        ['email' => $data['email']],
                        [
                            'name' => $dealer_name,
                            // 'password' => $data['password'],
                            // 'password' => bcrypt($data['password']),
                            // 'password' => bcrypt(Str::random(64)),  // placeholder since local DB password not used...
                        ]
                    );
                    \Log::info('after firstOrCreate: '.print_r($this->user, true));
                }

                // cannot use this for external API or SOAP data...
                // if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
                //    $this->throwFailureValidationException();
                // }
                \Log::info('user should be set here.'.print_r($this->user, true));
                if (isset($this->user)) {
                    Filament::auth()->login($this->user, $data['remember'] ?? false);
                } else {
                    $this->displayPersistentNotification('Could not create a Filament user with: '.print_r($this->user, true));
                }

                if (isset($this->user) &&
                ($this->user instanceof FilamentUser) &&
                    (! $this->user->canAccessPanel(Filament::getCurrentPanel()))
                ) {
                    Filament::auth()->logout();

                    $this->throwFailureValidationException();
                }

                session()->regenerate();

                return app(LoginResponse::class);
            }
        } else {
            $this->displayPersistentNotification('We are unable to process your request. Please try again.');

            // may need to log the response here...
            return null;
        }

        return null;
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
