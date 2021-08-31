<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

abstract class MasterController extends Controller
{
    protected $model;
    protected $route;

    public function __construct()
    {
        $this->middleware('auth:admin');
        $new_players_count=User::where('type','PLAYER')->where('created_at','>',Carbon::now()->subMonths(5))->count();
        $all_players_count=User::where('type','PLAYER')->count();

        $new_coaches_count=User::where('type','COACH')->where('created_at','>',Carbon::now()->subMonths(5))->count();
        $all_coaches_count=User::where('type','COACH')->count();

        $new_academies_count=User::where('type','ACADEMY')->where('created_at','>',Carbon::now()->subMonths(5))->count();
        $all_academies_count=User::where('type','ACADEMY')->count();

        $new_groups_count=Group::where('created_at','>',Carbon::now()->subMonths(5))->count();
        $all_groups_count=Group::count();

        $new_courses_count=Course::where('created_at','>',Carbon::now()->subMonths(5))->count();
        $all_courses_count=Course::count();

         view()->share(array(
            'new_players_count'=>$new_players_count,
            'all_players_count'=>$all_players_count>0?$all_players_count:1,
            'new_coaches_count'=>$new_coaches_count,
            'all_coaches_count'=>$all_coaches_count>0?$all_coaches_count:1,
            'new_academies_count'=>$new_academies_count,
            'all_academies_count'=>$all_academies_count>0?$all_academies_count:1,
            'new_groups_count'=>$new_groups_count,
            'all_groups_count'=>$all_groups_count>0?$all_groups_count:1,
            'new_courses_count'=>$new_courses_count,
            'all_courses_count'=>$all_courses_count>0?$all_courses_count:1,
           ));
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.' . $this->route . '.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.' . $this->route . '.create');
    }


    public function edit($id)
    {
        $row = $this->model->find($id);
        return View('Dashboard.' . $this->route . '.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, $this->validation_func(2, $id), $this->validation_msg());
        $obj = $this->model->find($id);
        $obj->update($request->all());
        return redirect()->back()->with('updated', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return redirect()->back()->with('deleted', 'تم الحذف بنجاح');
    }

    public function show($id)
    {
        $row = $this->model->find($id);
        return View('Dashboard.' . $this->route . '.show', compact('row'));
    }
}

