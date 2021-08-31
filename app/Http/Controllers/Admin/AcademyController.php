<?php

namespace App\Http\Controllers\Admin;

use App\Http\Enums\UserRole;
use App\Http\Requests\Dashboard\AcademyStoreRequest;
use App\Models\Academy;
use App\Models\AcademySize;
use App\Models\Ad;
use App\Models\Coach;
use App\Models\Country;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Http\Request;

class AcademyController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $rows = Academy::latest()->get();
        return view('academy.index', compact('rows'));
    }
    public function waiting(){
        $rows = Academy::get();
        return view('academy.waiting', compact('rows'));
    }
    public function create()
    {
        $countries=Country::all();
        $ads=Ad::all();
        $academy_sizes=AcademySize::all();
        $sports=Sport::all();
        return view('academy.create',compact('countries','ads','academy_sizes','sports'));
    }
    public function store(AcademyStoreRequest $request)
    {
        $data = $request->all();
        $data['type'] = 'ACADEMY';
        $user=User::create($data);
        $user->assignRole(UserRole::of(UserRole::ROLE_ACADEMY));
        $data['user_id']=$user->id;
        $data['location']=[
          'lat'=>$request['lat'],
          'lng'=>$request['lng'],
        ];
        $academy=Academy::create($data);
        if ($request['academy_size_id']==1){
            $data['academy_id']=$academy->id;
            Coach::create($data);
        }
        return redirect()->route('admin.academy.index')->with('created');
    }
    public function show($id):object
    {
        $row=Academy::find($id);
        return view('academy.show', compact('row'));
    }

    public function edit($id):object
    {
        $countries=Country::all();
        $ads=Ad::all();
        $academy_sizes=AcademySize::all();
        $row=Academy::find($id);
        $sports=Sport::all();
        return view('academy.edit', compact('row','countries','ads','academy_sizes','sports'));
    }
    public function update($id,Request $request)
    {
        $academy=Academy::find($id);
        $data = $request->all();
        $academy->user->update($data);
        $data['location']=[
            'lat'=>$request['lat'],
            'lng'=>$request['lng'],
        ];
        $academy->update($data);
        if ($request['academy_size_id']==1){
            $academy->user->coach->update($data);
        }

        return redirect()->route('admin.academy.index')->with('updated');
    }
}

