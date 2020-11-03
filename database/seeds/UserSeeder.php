<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'Admin name',
            'nickname' => 'Admin',
            'email' => 'admin@admin.com',
            'title' => 'System admin',
            'last_login_ip' => '123.234.23.23',
            'last_login_time' => '2020-09-01 18:39:43',
            'date_of_birth' => '2020-09-01',
            'city' => 'Brooklyn',
            'postal_or_zip_code' => '22343',
            'country' => 'USA',
            'state' => 'New York',
            'timezone' => 'CTD',
            'role' => 'admin',
            'tos_accepted' => 1,
            'receive_email_updates' => 1,
            'email_verified_at' => '2020-09-01 18:39:43',
            'password' => bcrypt('dfasdf'),
        ]);


        DB::table('users')->insert([
            'name' => 'moderator name',
            'nickname' => 'moderator',
            'email' => 'moderator@moderator.com',
            'title' => 'System moderator',
            'last_login_ip' => '123.234.23.23',
            'last_login_time' => '2020-09-01 18:39:43',
            'date_of_birth' => '2020-09-01',
            'city' => 'Brooklyn',
            'postal_or_zip_code' => '22343',
            'country' => 'USA',
            'state' => 'New York',
            'timezone' => 'CTD',
            'role' => 'moderator',
            'tos_accepted' => 1,
            'receive_email_updates' => 1,
            'email_verified_at' => '2020-09-01 18:39:43',
            'password' => bcrypt('sdfsdf'),
        ]);
    }
}
