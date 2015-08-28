<?php

namespace App\Http\Controllers\Auth;
use Input;
use App\User;
use Lang;
use App\Key;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar, User $user) {
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->user = $user;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin() {
        return view('auth.login');
    }
    
    /**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
                    $user = User::findByEmail($request->email);
                    $user->last_login = date('Y-m-d H:i:s');
                    $user->save();
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}
    

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function getRegister() {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest  $request
     * @return Response
     */
    public function postRegister(RegisterRequest $request) {
       
        $validator = $this->registrar->validator($request->all());
        
        if ($validator->fails()) {           
            $this->throwValidationException($request, $validator);
        }
        
        $keys = Input::get('code');
        $res = '';
        foreach($keys as $key => $value) {            
           $res .= $value;
        }
        
        $dbKey = Key::first();
       
        if($dbKey->key !== $res) {
           
            return redirect('auth/register')->with('error', Lang::get('site/user.key'))->withInput();
        }
        
        $this->auth->login($this->registrar->create($request->all()));
        return redirect('user/home');
    }
    
    

}
