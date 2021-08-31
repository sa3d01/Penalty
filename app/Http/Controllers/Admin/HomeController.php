<?php

namespace App\Http\Controllers\Admin;

use App\Models\Academy;
use App\Models\AcademySize;
use App\Models\Course;
use App\Models\Group;
use App\Models\Invoice;
use App\Models\Player;
use App\Models\Sport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    function academySports($academy_id): array
    {
        $academy = Academy::find($academy_id);
        $dataPoints = [];
        $dataSports = [];
        $sports = Sport::all();
        foreach ($sports as $sport) {
            $courses = Course::where(['sport_id' => $sport->id, 'academy_id' => $academy->id])->pluck('id')->toArray();
            $groups = Group::where(['sport_id' => $sport->id, 'academy_id' => $academy->id])->pluck('id')->toArray();
            $course_players = DB::table('course_player')->whereIn('course_id', $courses)->count();
            $group_players = DB::table('group_player')->whereIn('group_id', $groups)->count();
            $dataSports[] = $sport->name;
            $dataPoints[] = $course_players + $group_players;
        }
        $result['data'] = $dataPoints;
        $result['sports'] = $dataSports;
        return $result;
    }

    function academyProfits($academy_id): array
    {
        $academy = Academy::find($academy_id);
        $dataPoints = [];
        foreach ($academy->groups as $group) {
            $dataPoints[] = array(
                "name" => $group->name,
                "data" => [
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '01')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '02')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '03')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '04')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '05')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '06')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '07')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '08')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '09')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '10')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '11')->sum('amount'),
                    Invoice::where(['model' => 'Group', 'model_id' => $group->id])->whereMonth('created_at', '=', '12')->sum('amount'),
                ],
            );
        }
        foreach ($academy->courses as $course) {
            $dataPoints[] = array(
                "name" => $course->name,
                "data" => [
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '01')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '02')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '03')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '04')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '05')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '06')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '07')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '08')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '09')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '10')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '11')->sum('amount'),
                    Invoice::where(['model' => 'Course', 'model_id' => $course->id])->whereMonth('created_at', '=', '12')->sum('amount'),
                ],
            );
        }
        $result['data'] = $dataPoints;
        return $result;
    }

    function groupsData($groups): array
    {
        $colors = [];
        for ($i = 0; $i <= count($groups); $i++) {
            $colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        $dataPoints = [];
        foreach ($groups as $group) {
            $dataPoints[] = array(
                "name" => $group['name'],
                "data" => [
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '01')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '02')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '03')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '04')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '05')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '06')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '07')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '08')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '09')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '10')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '11')->count(),
                    DB::table('group_player')->where('group_id', $group->id)->whereMonth('created_at', '=', '12')->count(),
                ],
            );
        }
        $result['colors'] = $colors;
        $result['data'] = $dataPoints;
        return $result;
    }

    function academiesData($academies): array
    {
        $colors = [];
        for ($i = 0; $i <= count($academies); $i++) {
            $colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        $dataPoints = [];
        foreach (AcademySize::all() as $size) {
            $dataPoints[] = array(
                "name" => $size->name,
                "data" => [
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '01')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '02')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '03')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '04')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '05')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '06')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '07')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '08')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '09')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '10')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '11')->count(),
                    Academy::where('academy_size_id', $size->id)->whereMonth('created_at', '=', '12')->count(),
                ],
            );
        }
        $result['colors'] = $colors;
        $result['data'] = $dataPoints;
        return $result;
    }

    function analysisMonth($academy_id):array
    {
        $group_ids = Group::where('academy_id', $academy_id)->pluck('id')->toArray();
        $course_ids = Course::where('academy_id', $academy_id)->pluck('id')->toArray();

        $all_players_count = Player::where('academy_id', $academy_id)->count();
        $all_players_count = $all_players_count==0?1:$all_players_count;
        $new_players_count = Player::where('academy_id', $academy_id)->where('created_at','>',Carbon::now()->subMonth())->count();
        $new_players_ratio = round(($new_players_count/$all_players_count)*100);

        $all_group_subscribes_count = DB::table('group_player')->whereIn('group_id', $group_ids)->count();
        $all_group_subscribes_count = $all_group_subscribes_count==0?1:$all_group_subscribes_count;
        $new_group_subscribes_count = DB::table('group_player')->whereIn('group_id', $group_ids)->where('created_at','>',Carbon::now()->subMonth())->count();
        $new_group_subscribes_ratio = round(($new_group_subscribes_count/$all_group_subscribes_count)*100);

        $all_course_subscribes_count = DB::table('course_player')->whereIn('course_id', $course_ids)->count();
        $all_course_subscribes_count = $all_course_subscribes_count==0?1:$all_course_subscribes_count;
        $new_course_subscribes_count = DB::table('course_player')->whereIn('course_id', $course_ids)->where('created_at','>',Carbon::now()->subMonth())->count();
        $new_course_subscribes_ratio = round(($new_course_subscribes_count/$all_course_subscribes_count)*100);

        $group_invoices_count = Invoice::where('model','Group')->whereIn('model_id', $group_ids)->sum('amount');
        $course_invoices_count = Invoice::where('model','Course')->whereIn('model_id', $course_ids)->sum('amount');
        $all_invoices_amount=$group_invoices_count+$course_invoices_count;
        $all_invoices_amount=$all_invoices_amount==0?1:$all_invoices_amount;
        $new_group_invoices_count = Invoice::where('model','Group')->whereIn('model_id', $group_ids)->where('created_at','>',Carbon::now()->subMonth())->sum('amount');
        $new_course_invoices_count = Invoice::where('model','Course')->whereIn('model_id', $course_ids)->where('created_at','>',Carbon::now()->subMonth())->sum('amount');
        $new_invoices_amount=$new_group_invoices_count+$new_course_invoices_count;
        $new_invoices_amount_ratio = round(($new_invoices_amount/$all_invoices_amount)*100);

        $result['all_players_count']=$all_players_count;
        $result['new_players_count']=$new_players_count;
        $result['new_players_ratio']=$new_players_ratio;
        $result['all_group_subscribes_count']=$all_group_subscribes_count;
        $result['new_group_subscribes_count']=$new_group_subscribes_count;
        $result['new_group_subscribes_ratio']=$new_group_subscribes_ratio;
        $result['all_course_subscribes_count']=$all_course_subscribes_count;
        $result['new_course_subscribes_count']=$new_course_subscribes_count;
        $result['new_course_subscribes_ratio']=$new_course_subscribes_ratio;
        $result['all_invoices_amount']=$all_invoices_amount;
        $result['new_invoices_amount']=$new_invoices_amount;
        $result['new_invoices_amount_ratio']=$new_invoices_amount_ratio;
        return $result;
    }

    public function index()
    {
        if (auth()->user()->type == 'ACADEMY') {
            $groups = Group::where('academy_id', auth()->user()->academy->id)->latest()->get();
            $analysis_month=$this->analysisMonth(auth()->user()->academy->id);
            $first_chart_results = $this->groupsData($groups);
            $second_chart_results = $this->academyProfits(auth()->user()->academy->id);
            $third_chart_results = $this->academySports(auth()->user()->academy->id);
            $first_chart_title = 'اشتراكات اللاعبين بالجروبات';
            $second_chart_title = 'تحليل الإيرادات';
            $third_chart_title = 'تحليل الرياضات';
            $fourth_chart_title = 'تحليل الشهر';
        } elseif (auth()->user()->type == 'ADMIN') {
            if (in_array('ADMIN', auth()->user()->getRoleNames()->toArray()) && auth()->user()->admin->type == 'ACADEMY') {
                $groups = Group::where('academy_id', auth()->user()->admin->academy->id)->latest()->get();
                $analysis_month=$this->analysisMonth(auth()->user()->admin->academy->id);
                $first_chart_results = $this->groupsData($groups);
                $second_chart_results = $this->academyProfits(auth()->user()->admin->academy->id);
                $third_chart_results = $this->academySports(auth()->user()->academy->id);
                $first_chart_title = 'اشتراكات اللاعبين بالجروبات';
                $second_chart_title = 'تحليل الإيرادات';
                $third_chart_title = 'تحليل الرياضات';
                $fourth_chart_title = 'تحليل الشهر';
            } else {
                $academies = Academy::all();
                $analysis_month=$this->analysisMonth(auth()->id());
                $first_chart_results = $this->academiesData($academies);
                $second_chart_results = $this->academyProfits(auth()->id());
                $third_chart_results = $this->academySports(auth()->id());
                $first_chart_title = 'اشتراكات الأكاديميات';
                $second_chart_title = '';
                $third_chart_title = '';
                $fourth_chart_title = '';
            }
        } else {
            return view('errors.403');
        }
        return view("index", [
            "first_chart_data" => json_encode($first_chart_results['data']),
            "second_chart_data" => json_encode($second_chart_results['data']),
            "third_chart_data" => json_encode($third_chart_results['data']),
            "terms" => json_encode(array(
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            )),
            'colors' => json_encode($first_chart_results['colors']),
            'first_chart_title' => $first_chart_title,
            'second_chart_title' => $second_chart_title,
            'third_chart_title' => $third_chart_title,
            'fourth_chart_title' => $fourth_chart_title,
            'sports_data' => json_encode($third_chart_results['sports']),
            'analysis_month'=>$analysis_month
        ]);
    }
}
