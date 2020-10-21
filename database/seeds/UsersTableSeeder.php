<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@cbt.com';
        $user->password = Hash::make('admin123');
        $user->roles = ['admin'];
        $user->save();
    }
}
