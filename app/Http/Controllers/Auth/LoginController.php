<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Karmendra\LaravelAgentDetector\AgentDetector;
use App\Models\LoginInfo;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $agent = new AgentDetector($request->header('User-Agent'));
 


        // Log user login
        // LoginInfo::create([
        //     'user_id' => $user->id,
        //     'ip_address' => $request->ip(),
        //     'browser' => $agent->browser(),
        //     'device' => $agent->device(),
        //     'operating_system' => $agent->platform(),
        //     'operating_system_username' => php_uname('n'),
        //     'login_time' => now(),
        // ]);

        $loginInfo = new LoginInfo();
        $loginInfo->user_id = $user->id;
        $loginInfo->ip_address = $request->ip();
        $loginInfo->browser = $agent->browser();
        $loginInfo->device = $agent->device();
        $loginInfo->operating_system = $agent->platform();
        $loginInfo->operating_system_username = php_uname('n');
        $loginInfo->login_time = now();
        $loginInfo->save();

        // Redirect or perform any other actions after successful login
        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        // Log user logout
        if (Auth::check()) {
            $logoutTime = now();
            LoginInfo::where('user_id', Auth::user()->id)
                ->whereNull('logout_time')
                ->update(['logout_time' => $logoutTime]);
        }

        // Perform the default logout behavior
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect or perform any other actions after logout
        return redirect('/');
    }
}
