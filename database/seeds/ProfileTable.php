<?php

use Illuminate\Database\Seeder;
use Modules\profiles\models\Profiles;
class ProfileTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('profiles')->delete();

        $profiles = [
		["id"=>"1","name"=>"Super Administrator","role_access"=>"{}","status"=>'1'],
		["id"=>"2","name"=>"Administrator","role_access"=>"{}","status"=>'1'],
		["id"=>"3","name"=>"User","role_access"=>"{}","status"=>'1']
		];
		
		Profiles::insert($profiles);
    }
}
