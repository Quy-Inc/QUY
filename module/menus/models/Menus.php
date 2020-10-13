<?php

namespace Modules\menus\models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Menus extends Eloquent
{
    //
	protected $table = 'menus';
	protected $fillable = [
		'id_menu',
		'id_merchant',
		'id_kitchen',
		'id_category',
		'menu_code',
		'menu_name',
		'caption',
		'description',
		'components',
		'add_on_alternatives',
		'photos',
		'price',
		'extra_information',
		'status'
	];
}

