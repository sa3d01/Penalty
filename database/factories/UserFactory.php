<?php

namespace Database\Factories;

use App\Http\Enums\UserRole;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => '05'.rand(11111111,99999999),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'secret',
            'remember_token' => Str::random(10),
            'last_ip'=>$this->faker->localIpv4,
            'created_at'=>Carbon::now()->subMonths(rand(1,12)),
            'last_login_at'=>Carbon::now()->subDays(rand(1,12))
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function configure()
    {
        return $this->afterMaking(function (User $user) {
        })->afterCreating(function (User $user) {
            if ($user->type=='ACADEMY'){
                $role=Role::where('name',UserRole::of(UserRole::ROLE_ACADEMY))->first();
                $permissions=Permission::whereIn('id',[1,3,4,5,6,7])->pluck('id')->toArray();
                $role->syncPermissions($permissions);
                $user->assignRole($role);
            }elseif ($user->type=='COACH'){
                $user->assignRole(UserRole::of(UserRole::ROLE_COACH));
            }elseif ($user->type=='PLAYER'){
                $user->assignRole(UserRole::of(UserRole::ROLE_PLAYER));
            }
        });
    }
}
