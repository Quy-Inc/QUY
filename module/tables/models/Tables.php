<?php

namespace Modules\tables\models;
use Modules\venues\models\Venues;
use Modules\menus\models\Menus;
use Modules\merchants\models\Merchants;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Tables extends Eloquent
{
    //
	protected $table = 'tables';
	protected $fillable = [
		'id_table',
		'id_merchant',
		'id_venue',
		'table_code',
		'table_name',
		'caption',
		'description',
		'extra_information',
	];

	public function merchants(){
        return $this->belongsTo(Merchants::class,'id_merchant','_id');
	}
	
	public function venues(){
        return $this->belongsTo(Venues::class,'id_venue','id_venue');
	}
	
	public function menus(){
		return $this->hasMany(Menus::class,'id_merchant','id_merchant');
	}
}

