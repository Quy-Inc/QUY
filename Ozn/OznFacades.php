<?php namespace Ozn;

use Illuminate\Support\Facades\Facade;

class OznFacades extends Facade {
  protected static function getFacadeAccessor() { return 'ozn'; }
}