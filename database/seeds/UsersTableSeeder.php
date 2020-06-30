<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin')
        ]);

        $user1 = User::create([
            'name' => 'Toghrul Nasirli',
            'email' => 'toghrulnasirli111@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $user2 = User::create([
            'name' => 'Sabir Aliyev',
            'email' => 'sabir@aliyev.az',
            'password' => Hash::make('12345678')
        ]);
        $user3 = User::create([
            'name' => 'Ilyas Salamli',
            'email' => 'ilyas@salamli.az',
            'password' => Hash::make('12345678')
        ]);
        $user4 = User::create([
            'name' => 'Nicat Nesirov',
            'email' => 'nijat@nesirov.az',
            'password' => Hash::make('12345678')
        ]);
        $user5 = User::create([
            'name' => 'Nezrin Mehdizade',
            'email' => 'nazrin@mehdizade.az',
            'password' => Hash::make('12345678')
        ]);

        $admin->roles()->attach($adminRole);
        $user1->roles()->attach($userRole);
        $user2->roles()->attach($userRole);
        $user3->roles()->attach($userRole);
        $user4->roles()->attach($userRole);
        $user5->roles()->attach($userRole);
    }
}
