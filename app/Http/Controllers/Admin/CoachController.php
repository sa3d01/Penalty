<?php

namespace App\Http\Controllers\Admin;

use App\Http\Enums\UserRole;
use App\Http\Requests\Dashboard\AcademyStoreRequest;
use App\Http\Requests\Dashboard\CoachStoreRequest;
use App\Models\Academy;
use App\Models\AcademySize;
use App\Models\Ad;
use App\Models\Coach;
use App\Models\Country;
use App\Models\Player;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Http\Request;

class CoachController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (auth()->user()->type=='ACADEMY'){
            $rows=Coach::where('academy_id',auth()->user()->academy->id)->latest()->get();
        }elseif (auth()->user()->type=='ADMIN'){
            if (in_array('ADMIN',auth()->user()->getRoleNames()->toArray()) && auth()->user()->admin->type=='ACADEMY'){
                $rows=Coach::where('academy_id',auth()->user()->admin->academy->id)->latest()->get();
            }else{
                $rows = Coach::all();
            }
        }else{
            return view('errors.403');
        }

        return view('coach.index', compact('rows'));
    }
    public function create()
    {
        $sports=Sport::all();
        return view('coach.create',compact('sports'));
    }
    public function store(CoachStoreRequest $request)
    {
        $data = $request->all();
        $data['type'] = 'COACH';
        $user=User::create($data);
        $user->assignRole(UserRole::of(UserRole::ROLE_COACH));
        $data['user_id']=$user->id;
        Coach::create($data);
        return redirect()->route('admin.coach.index')->with('created');
    }

    public function show($id):object
    {
        $row=Coach::find($id);
        return view('coach.show', compact('row'));
    }

    public function edit($id):object
    {
        $sports=Sport::all();
        $row=Coach::find($id);
        return view('coach.edit', compact('row','sports'));
    }

    public function update($id,Request $request)
    {
        $row=Coach::find($id);
        $data = $request->all();
        $row->update($data);
        $row->user->update($data);
        return redirect()->route('admin.coach.index')->with('updated');
    }
}

