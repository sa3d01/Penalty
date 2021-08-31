<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\GroupStoreRequest;
use App\Models\Academy;
use App\Models\Activity;
use App\Models\Coach;
use App\Models\Course;
use App\Models\Group;
use App\Models\GroupDay;
use App\Models\Player;
use App\Models\Sport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (in_array('ACADEMY',auth()->user()->getRoleNames()->toArray())){
            $rows=Group::where('academy_id',auth()->user()->academy->id)->latest()->get();
        }else{
            $rows = Group::latest()->get();
        }
        return view('group.index', compact('rows'));
    }

    public function create()
    {
        $sports = Sport::all();
        $academies = Academy::all();
        if (auth()->user()->type=='ACADEMY'){
            $coaches=Coach::where('academy_id',auth()->user()->academy->id)->latest()->get();
            $players=Player::where('academy_id',auth()->user()->academy->id)->latest()->get();
        }elseif (auth()->user()->type=='ADMIN'){
            if (in_array('ADMIN',auth()->user()->getRoleNames()->toArray()) && auth()->user()->admin->type=='ACADEMY'){
                $coaches=Coach::where('academy_id',auth()->user()->admin->academy->id)->latest()->get();
                $players=Player::where('academy_id',auth()->user()->admin->academy->id)->latest()->get();
            }else{
                $coaches = Coach::all();
                $players = Player::all();
            }
        }else{
            return view('errors.403');
        }
        return view('group.create', compact('academies', 'sports','coaches','players'));
    }

    public function store(GroupStoreRequest $request)
    {
        $data = $request->all();
        $group = Group::create($data);
        $days = $request['days'];
        foreach ($days as $day) {
            GroupDay::create([
                'group_id' => $group->id,
                'name' => $day,
                'start_time' => Carbon::parse($request['start_time']),
                'duration' => $request['duration'],
                'activity_id' => 1,
                'comment' => $request['comment'],
            ]);
        }
        $group->players()->sync($request['players']);
        $group->coaches()->sync($request['coaches']);
        return redirect()->route('admin.group.index')->with('created');
    }

    public function show($id): object
    {
        $row = Group::find($id);
        return view('group.show', compact('row'));
    }

    public function edit($id): object
    {
        $sports = Sport::all();
        $academies = Academy::all();
        $row = Group::find($id);
        return view('group.edit', compact('row', 'sports', 'academies'));
    }

    public function update($id, Request $request)
    {
        $group = Group::find($id);
        $data = $request->all();
        $group->update($data);
        return redirect()->route('admin.group.index')->with('updated');
    }
}

