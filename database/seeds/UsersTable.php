<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::created([
            'name'      => 'Jaime Filho',
            'email'     =>  'jaime.vendrame@gmail.com',
            'password'  => bcrypt('secret'),
        ]);
    }
}
