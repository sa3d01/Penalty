<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $this->validator($request);
        if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
           $user = Auth::guard('admin')->user();
            if ($user->approved == 0){
                if($user->type !== 'ADMIN'){
                    Auth::guard('admin')->logout();
                    return redirect()
                        ->route('admin.login')
                        ->withInput()
                        ->withErrors(['حسابك معلق لحين مراجعة الإدارة لبياناتك ..']);
                }
           }
            $user->update([
               'last_ip'=>$request->ip(),
               'last_session_id'=>session()->getId(),
               'last_login_at'=>Carbon::now(),
               'remember_token'=>Str::random(10),
            ]);
            return redirect()
                ->intended(route('admin.home'))
                ->with('status','You are Logged in as Admin!');
        }
        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('admin.login')
            ->with('status','Admin has been logged out!');
    }

    private function validator(Request $request)
    {
        $rules = [
            'email'    => 'required|email|exists:users|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];
        $messages = [
            'email.exists' => 'هذا البريد غير مسجل!',
        ];
        $request->validate($rules,$messages);
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['يوجد مشاكل بالبيانات المدخلة .. من فضلك حاول ثانية']);
    }
}
