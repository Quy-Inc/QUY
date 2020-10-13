<?php

namespace Modules\stores\models;
use Modules\venues\models\Venues;
use Modules\merchants\models\Merchants;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Stores extends Eloquent
{
    //
	protected $table = 'stores';
	protected $fillable = [
		'id_merchant',
		'id_venue',
		'id_store',
		'caption',
		'store_name',
		'photos',
		'contacts',
		'extra_information',	
	];

	public function merchants(){
        return $this->belongsTo(Merchants::class,'id_merchant','_id');
	}
	
	public function venues(){
        return $this->belongsTo(Venues::class,'id_venue','_id');
    }
}

