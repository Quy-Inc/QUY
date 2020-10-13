<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = [
            ['id' => '1','name' => 'Ade Surya Bakti PAne','address' => 'Perum. Puri Tanjung Sari III B-1','email' => 'adesbpane@gmail.com','phone' => '2147483647','username' => 'adepane','password' => Hash::make('ayamgoreng'),'id_profile' => '1','status' => '1','remember_token' => null,'updated_at' => '2016-06-29 11:29:26','created_at' => null]
        ];

        User::insert($users);
    }
}
