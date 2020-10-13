<?php

namespace Modules\kitchens\models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kitchens extends Eloquent
{
    //
	protected $table = 'kitchens';
	protected $fillable = [
		'id_kitchen',
		'id_merchant',
		'kitchen_code',
		'kitchen_name',
		'caption',
		'description',
		'extra_information',
		'photos'
	];
}

