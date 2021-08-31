<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Group;
use App\Models\Invoice;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlayerInvoiceController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (auth()->user()->type == 'ACADEMY') {
            $rows = Player::where('academy_id', auth()->user()->academy->id)->latest()->get();
        } elseif (auth()->user()->type == 'ADMIN') {
            if (in_array('ADMIN', auth()->user()->getRoleNames()->toArray()) && auth()->user()->admin->type=='ACADEMY') {
                $rows = Player::where('academy_id', auth()->user()->admin->academy->id)->latest()->get();
            } else {
                $rows = Player::latest()->get();
            }
        } else {
            return view('errors.403');
        }
        return view('player-invoice.index', compact('rows'));
    }

    public function creditDetails($id)
    {
        $row = Player::find($id);
        $active_groups = Group::whereBanned(0)->pluck('id')->toArray();
        $player_groups = DB::table('group_player')->where('player_id', $row->id)->whereIn('group_id', $active_groups)->get();
        $player_courses = DB::table('course_player')->where('player_id', $row->id)->get();
        return view('player-invoice.create-invoice', compact('row', 'player_groups', 'player_courses'));
    }

    public function invoice($invoice_id)
    {
        $invoices = Invoice::where('invoice_id', $invoice_id)->get();
        $sub_total = Invoice::where('invoice_id', $invoice_id)->sum('amount');
        $player = $invoices->first()->user->player;
        return view('player-invoice.invoice', compact('invoice_id', 'invoices', 'player', 'sub_total'));
    }

    public function invoicing($id, Request $request)
    {
        $player = Player::find($id);
        $active_groups = Group::whereBanned(0)->pluck('id')->toArray();
        $player_groups = DB::table('group_player')->where('player_id', $player->id)->whereIn('group_id', $active_groups)->get();
        $player_courses = DB::table('course_player')->where('player_id', $player->id)->get();
        $data['user_id'] = $player->user_id;
        $data['cashier_id'] = Auth::id();
        $invoice_id = rand(111111, 999999);
        $data['invoice_id'] = $invoice_id;
        foreach ($player_groups as $player_group) {
            $months_list = $this->getMonthListFromDate(Carbon::parse($player_group->created_at));
            $last_invoices_months = \App\Models\Invoice::where('user_id', $player->user_id)->where(['model' => 'Group', 'model_id' => $player_group->group_id])->pluck('month')->toArray();
            $debit_months = array_diff($months_list, $last_invoices_months);
            $group = Group::find($player_group->group_id);
            $data['model'] = 'Group';
            $data['model_id'] = $group->id;
            foreach ($debit_months as $debit_month) {
                $data['month'] = $debit_month;
                $data['amount'] = $group->price;
                Invoice::create($data);
            }
        }
        foreach ($player_courses as $player_course) {
            $course = Course::find($player_course->course_id);
            $data['month'] = null;
            $data['model'] = 'Course';
            $data['model_id'] = $player_course->course_id;
            $data['amount'] = $course->price;
            Invoice::create($data);
        }
        return redirect()->route('admin.player.invoice', $invoice_id)->with('invoiced');
    }

    public function getMonthListFromDate(Carbon $date)
    {
        $end = new \DateTime(); // Today date
        $start = new \DateTime($date->toDateTimeString()); // Create a datetime object from your Carbon object
        $interval = \DateInterval::createFromDateString('1 month'); // 1 month interval
        $period = new \DatePeriod($start, $interval, $end); // Get a set of date beetween the 2 period
        $months = array();
        foreach ($period as $dt) {
            $months[] = $dt->format("F Y");
        }
        return $months;
    }
}

