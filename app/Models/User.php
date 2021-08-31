<?php

namespace App\Models;

use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasMediaTrait;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'type',
        'avatar',
        'name',
        'phone',
        'email',
        'password',
        'gender',
        'banned',
        'approved',
        'reject_reason',
        'last_ip',
        'last_session_id',
        'last_login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    protected function getAvatarAttribute()
    {
        $file = $this->getMedia("avatars")->first();
        if ($file) {
            return $this->getMedia("avatars")->first()->getFullUrl('thumb');
        }
        if ($this->attributes['gender']=='female'){
            return asset('media/images/default-female.png');
        }else{
            return asset('media/images/default-male.jpeg');
        }
    }

    protected function setAvatarAttribute($image)
    {
        $this->clearMediaCollection("avatars");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $this->addMedia($image)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection("avatars");
    }

    public function getAllPermissionsAttribute(): array
    {
        $res = [];
        $allPermissions = $this->getAllPermissions();
        foreach ($allPermissions as $p) {
            $res[] = $p->name;
        }
        return $res;
    }

    public function getRoleArabicName(): string
    {
        $role = $this->roles()->first();
        return $role->name ?? '';
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id','id');
    }
    public function academy()
    {
        return $this->hasOne(Academy::class);
    }

    public function coach()
    {
        return $this->hasOne(Coach::class);
    }

    public function player()
    {
        return $this->hasOne(Player::class);
    }

    public function credit()
    {
        if (auth()->user()->type=='ACADEMY'){
            $active_groups=Group::where('academy_id',auth()->user()->academy->id)->whereBanned(0)->pluck('id')->toArray();
            $active_courses=Course::where('academy_id',auth()->user()->academy->id)->whereBanned(0)->pluck('id')->toArray();
        }elseif (auth()->user()->type=='ADMIN'){
            if (in_array('ADMIN',auth()->user()->getRoleNames()->toArray()) && auth()->user()->admin->type=='ACADEMY'){
                $active_groups=Group::where('academy_id',auth()->user()->admin->academy->id)->whereBanned(0)->pluck('id')->toArray();
                $active_courses=Course::where('academy_id',auth()->user()->admin->academy->id)->whereBanned(0)->pluck('id')->toArray();
            }else{
                $active_groups=Group::whereBanned(0)->pluck('id')->toArray();
                $active_courses=Course::whereBanned(0)->pluck('id')->toArray();
            }
        }else{
            return view('errors.403');
        }
        $player_groups=DB::table('group_player')->where('player_id',$this->player->id)->whereIn('group_id',$active_groups)->get();
        $amount=0;
        foreach ($player_groups as $group_player){
            $months_list= $this->getMonthListFromDate(Carbon::parse($group_player->created_at));
            $last_invoices_months=Invoice::where('user_id',$this->id)->where(['model'=>'Group','model_id'=>$group_player->group_id])->pluck('month')->toArray();
            $debit_months=array_diff($months_list,$last_invoices_months);
            $group=Group::find($group_player->group_id);
            if (!$group)
                return -1;
            $amount+=$group->price * count($debit_months);
        }
        $courses_players=DB::table('course_player')->where('player_id',$this->player->id)->whereIn('course_id',$active_courses)->where('payed',false)->get();
        foreach ($courses_players as $courses_player)
        {
            $course=Course::find($courses_player->course_id);
            if (!$course)
                return -1;
            $invoiced=\App\Models\Invoice::where('user_id',$this->id)->where(['model'=>'Course','model_id'=>$courses_player->course_id])->first();
            if ($invoiced){
                continue;
            }
            $amount+=$course->price;
        }
        return $amount;
    }

    public function getMonthListFromDate(Carbon $date)
    {
        $end    = new \DateTime(); // Today date
        $start      = new \DateTime($date->toDateTimeString()); // Create a datetime object from your Carbon object
        $interval = \DateInterval::createFromDateString('1 month'); // 1 month interval
        $period   = new \DatePeriod($start, $interval, $end); // Get a set of date beetween the 2 period
        $months = array();
        foreach ($period as $dt) {
            $months[] = $dt->format("F Y");
        }
        return $months;
    }
}
