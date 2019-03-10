<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Author;
use ReflectionClass;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        return config('ldap_auth.usernames.eloquent');
    }

    protected function validateLogin(Request $request) {
        $this->validate($request, [
                $this->username() => 'required|string|regex:/^\w+$/',
                'password'        => 'required|string',
            ]);
    }

    protected function attemptLogin(Request $request) {
        $credentials = $request->only($this->username(), 'password');
        $username    = $credentials[$this->username()];
        $password    = $credentials['password'];
        $user_format = env('LDAP_USER_FORMAT', 'cn=%s,'.env('LDAP_BASE_DN', ''));
        $userdn      = sprintf($user_format, $username);

        if(Adldap::auth()->attempt($userdn, $password, $bindAsUser = TRUE)) {
            // the user doesn't exist in the local database, so we have to create one
            if (! $user = User::where($this->username(), $username)->first()) {
                $user = new User();
                $user->username = $username;
                $user->password = '';
            }

            $ldapUser = Adldap::search()->where(env('LDAP_USER_ATTRIBUTE'), '=', $username)->first();
            $sync_attrs = $this->retrieveSyncAttributes($ldapUser);
            foreach ($sync_attrs as $field => $value) {
                $user->$field = $value !== NULL ? $value : NULL;
            }

            Author::firstOrCreate(['name' => $user->name]);

            $this->guard()->login($user, TRUE);
            $user->update();
            return TRUE;
        } else {
            return FALSE;
        }

    }

    protected function retrieveSyncAttributes($ldapUser) {
        $ldapuser_attrs = NULL;
        $attrs = [];

        foreach (config('ldap_auth.sync_attributes') as $local_attr => $ldap_attr) {
            if ($local_attr == 'username') {
                continue;
            }

            $method = 'get' . $ldap_attr;
            if (method_exists($ldapUser, $method)) {
                $attrs[$local_attr] = $ldapUser->$method();
                continue;
            }

            if ($ldapuser_attrs === NULL) {
                $ldapuser_attrs = self::accessProtected($ldapUser, 'attributes');
            }

            if (!isset($ldapuser_attrs[$ldap_attr])) {
                $attrs[$local_attr] = NULL;
                continue;
            }

            if (!is_array($ldapuser_attrs[$ldap_attr])) {
                $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr];
            }

            if (count($ldapuser_attrs[$ldap_attr]) == 0) {
                $attrs[$local_attr] = NULL;
                continue;
            }

            $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr][0];
        }

        return $attrs;
    }

    protected static function accessProtected ($obj, $prop) {
        $reflection = new ReflectionClass($obj);
        $property   = $reflection->getProperty($prop);
        $property->setAccessible(TRUE);
        return $property->getValue($obj);
    }
}
