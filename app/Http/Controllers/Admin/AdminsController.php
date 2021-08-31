<?php

namespace App\Http\Controllers\Admin;

use App\Http\Enums\UserRole;
use App\Models\Coach;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminsController extends MasterController
{
    function __construct(User $model)
    {
//        $this->middleware('permission:admins');
        parent::__construct();

    }
    public function index()
    {
        $rows = User::whereType('ADMIN')->where('admin_id',auth()->id())->get();
        return view('admin.index', compact('rows'));

    }

    public function create()
    {
        if (in_array('ACADEMY',auth()->user()->getRoleNames()->toArray())){
            $permissions=Permission::whereIn('id',[3,4,5,6,7])->latest()->get();
        }else{
            $permissions=Permission::whereIn('id',[2,3,4,5,6,7,8])->latest()->get();
        }
        return view('admin.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'permissions' => 'required'
        ]);
        $input = $request->all();
        $input['type']='ADMIN';
        $user = User::create($input);
        $role=Role::where('name',UserRole::of(UserRole::ROLE_ADMIN))->first();
        $user->assignRole($role);
        $permissions=Permission::whereIn('id',$request['permissions'])->pluck('name')->toArray();
        $user->givePermissionTo($permissions);
        return redirect()->route('admin.admins.index')->with('created');
    }


    public function edit($id)
    {
        $admin = User::find($id);
        $adminPermissions = $admin->permissions->pluck('id')->toArray();
        if ($admin->admin->type=='ACADEMY'){
            $permissions=Permission::whereIn('id',[3,4,5,6,7])->latest()->get();
        }else{
            $permissions=Permission::whereIn('id',[2,3,4,5,6,7,8])->latest()->get();
        }
        return view('admin.edit',compact('permissions','admin','adminPermissions'));
     }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required',
            'permissions' => 'required'
        ]);
        $input = $request->all();
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_permissions')->where('model_id',$id)->delete();
        $permissions=Permission::whereIn('id',$request['permissions'])->pluck('name')->toArray();
        $user->givePermissionTo($permissions);
        return redirect()->route('admin.admins.index')->with('created');
    }

}
