<?php

namespace App\Http\Controllers;

use Modules\menus\models\Menus;
use Modules\merchants\models\Merchants;
use Modules\tables\models\Tables;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function tables(Request $request,$id)
    {
        $Tables = new Tables;
        $getTables = $Tables->with("merchants")->with('venues')->with('menus')->where("id_table",$id)->get()->first()->toArray();

        return json_encode($getTables);
        //return $getTables;
    }

}
