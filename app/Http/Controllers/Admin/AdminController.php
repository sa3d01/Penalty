<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\Auth\ProfileUpdateRequest;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function profile()
    {
        $row = Auth::user();
        return view('auth.profile', compact('row'));
    }

    public function updateProfile(ProfileUpdateRequest $request): object
    {
        $admin = Auth::user();
        $admin->update($request->validated());
        return redirect()->back()->with('updated', 'تم التعديل بنجاح');
    }

}
