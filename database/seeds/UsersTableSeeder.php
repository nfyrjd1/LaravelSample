<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор неизвестен',
                'email' => 'unknown@laravel.local',
                'password' => bcrypt(str_random(16)),
            ],
            [
                'name' => 'Администратор',
                'email' => 'root@laravel.local',
                'password' => bcrypt('root'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
