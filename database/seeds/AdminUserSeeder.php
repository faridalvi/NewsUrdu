<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ghulam Farid',
            'email' => 'ghulam.farid@tuf.edu.pk',
            'password' => bcrypt('12345678'),
            'is_active'=> 1,
            'last_login'=>Carbon::now(),
            'email_verified_at'=>Carbon::now()
        ]);

        $role = Role::create(['name' => 'Super Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
