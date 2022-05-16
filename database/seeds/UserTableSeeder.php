<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $adminRole = Role::where('name', 'admin')->first();
        $sellerRole = Role::where('name', 'seller')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);

        $seller = User::create([
            'name' => 'Seller User',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'name' => 'User User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach( $adminRole );
        $user->roles()->attach( $userRole );
        $seller->roles()->attach( $sellerRole );
        

    }
}
