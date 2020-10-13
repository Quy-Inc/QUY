<?php

namespace Modules\profiles\models;

#use Moloquent\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;



class Profiles extends Eloquent
{
    //
	 #protected $connection = 'mongodb';
	 protected $table = 'profiles';
	 protected $fillable = [
			'id','name','role_access','status','created_at','update_at'
	 ];
}
