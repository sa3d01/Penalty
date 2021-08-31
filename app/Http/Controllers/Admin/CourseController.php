<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\GroupStoreRequest;
use App\Models\Academy;
use App\Models\Coach;
use App\Models\Course;
use App\Models\CourseDay;
use App\Models\Group;
use App\Models\GroupDay;
use App\Models\Player;
use App\Models\Sport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (in_array('ACADEMY',auth()->user()->getRoleNames()->toArray())){
            $rows=Course::where('academy_id',auth()->user()->academy->id)->latest()->get();
        }else{
            $rows = Course::latest()->get();
        }
        return view('course.index', compact('rows'));
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
        return view('course.create', compact('academies', 'sports','coaches','players'));
    }

    public function store(GroupStoreRequest $request)
    {
        $data = $request->all();
        $course = Course::create($data);

        $start_date = Carbon::parse($course->from_date)->format('Y-m-d');
        $end_date = Carbon::parse($course->to_date)->format('Y-m-d');
        while ($start_date <= $end_date) {
            if (in_array(Carbon::parse($start_date)->dayName, $course->days)) {
                CourseDay::create([
                    'course_id' => $course->id,
                    'date' => $start_date,
                    'start_time' => Carbon::parse($request['start_time']),
                    'duration' => $request['duration'],
                    'activity_id' => 1,
                    'comment' => $request['comment'],
                ]);
            }
            $start_date = Carbon::parse($start_date)->addDay();
        }
        $course->players()->sync($request['players']);
        $course->coaches()->sync($request['coaches']);
        return redirect()->route('admin.course.index')->with('created');
    }

    public function show($id): object
    {
        $row = Course::find($id);
        return view('course.show', compact('row'));
    }

    public function edit($id): object
    {
        $sports = Sport::all();
        $academies = Academy::all();
        $row = Course::find($id);
        return view('course.edit', compact('row', 'sports', 'academies'));
    }

    public function update($id, Request $request)
    {
        $course = Course::find($id);
        $data = $request->all();
        $course->update($data);
        return redirect()->route('admin.course.index')->with('updated');
    }
}

