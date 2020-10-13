<?php

namespace Modules\venues\models;
use Modules\merchants\models\Merchants;
use Modules\tables\models\Tables;
use Modules\stores\models\Stores;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Venues extends Eloquent
{
    //
	protected $table = 'venues';
	protected $fillable = [
		'id_venues',
		'id_merchant',
		'venues_name',
		'caption',
		'photos',
		'address',
		'contacts',
		'extra_information',
		'status',
	];

	public function merchants(){
        return $this->belongsTo(Merchants::class,'id_merchant','_id');
	}
	
	public function storesList(){
        return $this->hasMany(Stores::class,'id_venue','_id');
	}
	
	public function tablesList(){
        return $this->hasMany(Tables::class,'id_venues','_id');
    }
		
}

