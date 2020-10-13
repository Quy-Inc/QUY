<?php

namespace Modules\merchants\models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Merchants extends Eloquent
{
    //
	protected $table = 'merchants';
	protected $fillable = [
		'id_merchant',
		'merchant_name',
		'company_name',
		'caption',
		'contacts',
		'address',
		'activation',
		'logo',
		'extra_information',
		'registration_date'
	];

	protected $dates = [
		'registration_date'
	];
}

