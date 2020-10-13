<?php

use Illuminate\Database\Seeder;
use Modules\provinsi\models\Provinsi;
class ProvinsiTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('provinsi')->delete();

        $provinsi = [
          ["id_prov"=>"11","name"=>"ACEH"],
          ["id_prov"=>"12","name"=>"SUMATERA UTARA"],
          ["id_prov"=>"13","name"=>"SUMATERA BARAT"],
          ["id_prov"=>"14","name"=>"RIAU"],
          ["id_prov"=>"15","name"=>"JAMBI"],
          ["id_prov"=>"16","name"=>"SUMATERA SELATAN"],
          ["id_prov"=>"17","name"=>"BENGKULU"],
          ["id_prov"=>"18","name"=>"LAMPUNG"],
          ["id_prov"=>"19","name"=>"KEPULAUAN BANGKA BELITUNG"],
          ["id_prov"=>"21","name"=>"KEPULAUAN RIAU"],
          ["id_prov"=>"31","name"=>"DKI JAKARTA"],
          ["id_prov"=>"32","name"=>"JAWA BARAT"],
          ["id_prov"=>"33","name"=>"JAWA TENGAH"],
          ["id_prov"=>"34","name"=>"DI YOGYAKARTA"],
          ["id_prov"=>"35","name"=>"JAWA TIMUR"],
          ["id_prov"=>"36","name"=>"BANTEN"],
          ["id_prov"=>"51","name"=>"BALI"],
          ["id_prov"=>"52","name"=>"NUSA TENGGARA BARAT"],
          ["id_prov"=>"53","name"=>"NUSA TENGGARA TIMUR"],
          ["id_prov"=>"61","name"=>"KALIMANTAN BARAT"],
          ["id_prov"=>"62","name"=>"KALIMANTAN TENGAH"],
          ["id_prov"=>"63","name"=>"KALIMANTAN SELATAN"],
          ["id_prov"=>"64","name"=>"KALIMANTAN TIMUR"],
          ["id_prov"=>"65","name"=>"KALIMANTAN UTARA"],
          ["id_prov"=>"71","name"=>"SULAWESI UTARA"],
          ["id_prov"=>"72","name"=>"SULAWESI TENGAH"],
          ["id_prov"=>"73","name"=>"SULAWESI SELATAN"],
          ["id_prov"=>"74","name"=>"SULAWESI TENGGARA"],
          ["id_prov"=>"75","name"=>"GORONTALO"],
          ["id_prov"=>"76","name"=>"SULAWESI BARAT"],
          ["id_prov"=>"81","name"=>"MALUKU"],
          ["id_prov"=>"82","name"=>"MALUKU UTARA"],
          ["id_prov"=>"91","name"=>"PAPUA BARAT"],
          ["id_prov"=>"94","name"=>"PAPUA"]
		];

		Provinsi::insert($provinsi);
    }
}
