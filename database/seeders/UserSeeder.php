<?php

namespace Database\Seeders;

use App\Http\Enums\UserRole;
use App\Models\Academy;
use App\Models\Coach;
use App\Models\Course;
use App\Models\Group;
use App\Models\Player;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
        $this->createSuperAdmin();
        $this->createAcademy();
        $this->createCoach();
        $this->createPlayer();
    }

    private function createRoles()
    {
        foreach (UserRole::ROLES as $id => $roleEnum) {
            Role::findOrCreate($roleEnum);
        }
    }

    private function createSuperAdmin()
    {
        $user = User::create([
            'type' => 'ADMIN',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '0512345622',
            'password' => "secret",
            'remember_token' => Str::random(10),
        ]);
        $role=Role::where('name',UserRole::of(UserRole::ROLE_SUPER_ADMIN))->first();
        $permissions=Permission::whereIn('id',[1,2,3,4,5,6,7,8])->pluck('id')->toArray();
        $role->syncPermissions($permissions);
        $user->assignRole($role);
    }

    private function createAcademy()
    {
        User::factory()->count(15)->state(new Sequence(function ($sequence) {
            return ['type' => 'ACADEMY', 'name' => 'ACADEMY ' . $sequence->index];
        },))
            ->has(Academy::factory()->count(1)->state(function (array $attributes, User $user) {
                return ['created_at' => $user->created_at];
            })
                ->has(Course::factory()->count(rand(2, 9))->state(function (array $attributes, Academy $academy) {
                    return ['name' => 'course- ' .rand(0,9999),'created_at' => Carbon::parse($academy->created_at)->addDays(rand(1, 120))];
                }))
                ->has(Group::factory()->count(rand(2, 9))->state(function (array $attributes, Academy $academy) {
                    return ['name' => 'group- ' . rand(0,9999),'created_at' => Carbon::parse($academy->created_at)->addDays(rand(1, 120))];
                }))
            )
            ->create();
    }

    private function createCoach()
    {
        User::factory()
            ->count(40)
            ->state(new Sequence(
                function ($sequence) {
                    return [
                        'type' => 'COACH',
                        'name' => 'COACH ' . $sequence->index,
                    ];
                },
            ))
            ->has(
                Coach::factory()
                    ->count(1)
                    ->state(function (array $attributes, User $user) {
                        return [
                            'created_at' => $user->created_at
                        ];
                    })
            )
            ->create();
    }

    private function createPlayer()
    {
        User::factory()
            ->count(250)
            ->state(new Sequence(
                function ($sequence) {
                    return [
                        'type' => 'PLAYER',
                        'name' => 'PLAYER ' . $sequence->index,
                    ];
                },
            ))
            ->has(
                Player::factory()
                    ->count(1)
                    ->state(function (array $attributes, User $user) {
                        return [
                            'created_at' => $user->created_at
                        ];
                    })
            )
            ->create();
    }
}
