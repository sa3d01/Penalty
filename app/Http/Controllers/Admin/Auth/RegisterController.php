<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Enums\UserRole;
use App\Http\Requests\Dashboard\AcademyStoreRequest;
use App\Models\Academy;
use App\Models\AcademySize;
use App\Models\Ad;
use App\Models\Coach;
use App\Models\Country;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class RegisterController extends Controller
{
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    use AuthenticatesUsers;

    public function showRegisterForm()
    {
        $countries = Country::all();
        $ads = Ad::all();
        $academy_sizes = AcademySize::all();
        $sports = Sport::all();
        return view('auth.register', compact('countries', 'ads', 'academy_sizes', 'sports'));
    }


    public function register(AcademyStoreRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $user->assignRole(UserRole::of(UserRole::ROLE_ACADEMY));
        $data['user_id'] = $user->id;
        $data['location'] = [
            'lat' => $request['lat'],
            'lng' => $request['lng'],
        ];
        $academy = Academy::create($data);
        if ($request['academy_size_id'] == 1) {
            $data['academy_id'] = $academy->id;
            Coach::create($data);
        }
        return redirect()
            ->intended(route('admin.home'))
            ->with('status', 'You are Logged in as Admin!');
    }

}
