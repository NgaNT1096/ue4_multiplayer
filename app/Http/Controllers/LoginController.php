<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $this->validateLogin($request);

        //retrieveByCredentials
        if ($user = app('auth')->getProvider()->retrieveByCredentials($request->only('email', 'password'))) {
            $token = Token::create([
                'user_id' => $user->id
            ]);

            if ($token->sendCode()) {
                session()->set("token_id", $token->id);
                session()->set("user_id", $user->id);
                session()->set("remember", $request->get('remember'));

                return redirect("code");
            }

            $token->delete();// delete token because it can't be sent
            return redirect('/login')->withErrors([
                "Unable to send verification code"
            ]);
        }

        return redirect()->back()
            ->withInputs()
            ->withErrors([
                $this->username() => Lang::get('auth.failed')
            ]);
    }
}
