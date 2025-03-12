<?php

namespace App\Filament\Actions;

use App\Services\Soap\EliecontService\LoginService;
// use Filament\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateLogin
{
    protected LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function __invoke(Request $request)
    {
        //
    }

    protected function findOrCreateUser($email): \App\Models\User
    {
        return \App\Models\User::firstOrCreate([
            'email' => $email,
        ], [
            'password' => bcrypt('default_password'),
            'name' => 'Default Name',
        ]);
    }
}
