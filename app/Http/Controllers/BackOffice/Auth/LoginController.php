<?php

namespace App\Http\Controllers\BackOffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /**
     * @var AuthManager
     */
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }


    protected function guard()
    {
        return $this->authManger->guard('web-admin');
    }

    public function showLoginForm() {
        return view('back_office.auth.login');
    }

    private function credentials(array $form): array {
        return [
            'email' => $form['email'],
            'password' => $form['encrypted_password']
        ];
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if($this->authManager->guard('web-admin')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])){
            return redirect()->intended(route('back.secure.home'));
        }

        return back();
    }

    public function logout() {
        $this->authManager->guard('web-admin')->logout();
        return redirect(route('back.login'));
    }
}
