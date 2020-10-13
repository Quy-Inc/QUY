<?php

namespace Modules\menucategories\models;

use Modules\merchants\models\Merchants;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Menucategories extends Eloquent
{
    //
	protected $table = 'menucategories';
	protected $fillable = [
		'id_category',
		'id_merchant',
		'category_name',
		'caption',
		'description',
		'extra_information',
		'photos'
	];

	public function merchants(){
        return $this->belongsTo(Merchants::class,'id_merchant','_id');
	}
	
}

