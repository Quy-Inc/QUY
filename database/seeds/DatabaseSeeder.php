<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTable::class);
        $this->call(ProfileTable::class);
        $this->call(ProvinsiTable::class);
        $this->call(KabupatenTable::class);
    }
}
