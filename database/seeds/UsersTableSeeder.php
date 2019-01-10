<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::created([
            'name'      => 'Anonymo',
            'email'     =>  'anonymo@email.com',
            'password'  => bcrypt('secret'),
            'biography' => 'Usuário Anonymous',
        ]);

        factory(\App\User::class,1)
            ->create([
                'name' => 'Anonymo',
                'email' => 'anonymo@email.com.br',
                'password'  => bcrypt('secret'),
                'biography' => 'Usuário Anonymous',
            ]);
        factory(\App\User::class,1)
            ->create([
                'name'      => 'Jaime Filho',
                'email'     =>  'jaime.vendrame@gmail.com',
                'password'  => bcrypt('secret'),
                'biography' => 'Usuário Admin',
            ]);

    }
}
