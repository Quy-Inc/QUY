<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Modules\witel\models\Witel;
use Modules\psbta\models\Psbta;
use Modules\sto\models\Sto;
use Modules\pek\models\Pek;
use Modules\mitraTa\models\MitraTa;
use Modules\tatelkom\models\Tatelkom;
use Modules\biaya\models\Biaya;


use Excel;
class importPsbta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data {data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data PSB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
      $file = $this->argument('data');
      $lokasifile = public_path().'/files/'.$this->argument('data');
      $csv_complete_contents = array_map('str_getcsv', file($lokasifile));
      $csv_complete_filtered = array_filter(array_map('array_filter', $csv_complete_contents));
      $bar = $this->output->createProgressBar(count($csv_complete_filtered));
      $data = Excel::load($lokasifile, function($reader) {})->get();

        if(!empty($data)){
          foreach ($data as $key => $value) {

            $witel = Witel::where(function($x)use($value){
                $x->orWhere("nama_witel",ucfirst($value->witel))
                  ->orWhere("nama_witel",strtolower($value->witel))
                  ->orWhere("nama_witel",$value->witel);
            })->get()->first();
            
            if(!empty($witel)){
                $id_witel = $witel->_id;
            }else{
                $cwitel = new Witel;
                $cwitel->nama_witel = $value->witel;
                $cwitel->alamat = '-';
                $cwitel->pic = '-';
                $cwitel->telepon = '-';

                if ($cwitel->save()) {
                 $id_witel = $cwitel->_id;
                }
            }

            $sto = Sto::where(function($x)use($value){
                $x->orWhere("nama_sto",ucfirst($value->sto))
                  ->orWhere("nama_sto",strtolower($value->sto))
                  ->orWhere("nama_sto",$value->sto);
            })->get()->first();
            
            if(!empty($sto)){
                $id_sto = $sto->_id;
            }else{
                $csto = new Sto;
                $csto->nama_sto = $value->sto;
                $csto->kode_sto = '-';
                $csto->alamat_sto = '-';

                if ($csto->save()) {
                 $id_sto= $csto->_id;
                }
            }

            $pek = Pek::where(function($x)use($value){
                $x->orWhere("nama_pek",ucfirst($value->pek))
                  ->orWhere("nama_pek",strtolower($value->pek))
                  ->orWhere("nama_pek",$value->pek);
            })->get()->first();
            
            if(!empty($pek)){
                $id_pek = $pek->_id;
            }else{
                $cpek = new Pek;
                $cpek->nama_pek = $value->pek;
                $cpek->kode_pek = '-';

                if ($cpek->save()) {
                 $id_pek= $cpek->_id;
                }
            }

            $mitraTa = MitraTa::where(function($x)use($value){
                $x->orWhere("nama_mitra",ucfirst($value->mitrata))
                  ->orWhere("nama_mitra",strtolower($value->mitrata))
                  ->orWhere("nama_mitra",$value->mitrata);
            })->get()->first();
            
            if(!empty($mitraTa)){
                $id_mitraTa = $mitraTa->_id;
            }else{
                $cmitraTa = new mitraTa;
                $cmitraTa->kode_mitra = '-';
                $cmitraTa->nama_mitra = $value->mitrata;
                $cmitraTa->alamat_mitra = '-';
                $cmitraTa->no_hp = '-';

                if ($cmitraTa->save()) {
                 $id_mitraTa= $cmitraTa->_id;
                }
            }

            $tatelkom = Tatelkom::where(function($x)use($value){
                $x->orWhere("name",ucfirst($value->ta_telkom))
                  ->orWhere("name",strtolower($value->ta_telkom))
                  ->orWhere("name",$value->ta_telkom);
            })->get()->first();
            
            if(!empty($tatelkom)){
                $id_tatelkom = $tatelkom->_id;
            }else{
                $ctatelkom = new Tatelkom;
                $ctatelkom->name = $value->ta_telkom;
                $ctatelkom->keterangan = '-';

                if ($ctatelkom->save()) {
                 $id_tatelkom= $ctatelkom->_id;
                }
            }

            $biaya = Biaya::where(function($x)use($value){
                $x->orWhere("name",ucfirst($value->biaya_per_m))
                  ->orWhere("name",strtolower($value->biaya_per_m))
                  ->orWhere("name",$value->biaya_per_m);
            })->get()->first();
            
            if(!empty($biaya)){
                $id_biaya = $biaya->_id;
            }else{
                $cbiaya = new Biaya;
                $cbiaya->name = '-';
                $cbiaya->biaya = $value->biaya_per_m;

                if ($cbiaya->save()) {
                 $id_biaya= $cbiaya->_id;
                }
            }
            
          $modul = new Psbta;
          $modul->no_inet = $value->no_inet;
          $modul->id_witel = $id_witel;
          $modul->id_sto = $id_sto;
          $modul->id_pek = $id_pek;
          $modul->id_mitraTa = $id_mitraTa;
          $modul->tipe = $value->tipe;
          $modul->nosc_notid = $value->nosc_notid;
          $modul->tgl_wo = $value->tgl_wo;
          $modul->tgl_ps = $value->tgl_ps;
          $modul->id_tatelkom = $id_tatelkom;
          $modul->nama_odp = $value->nama_odp;
          $modul->sp_mtr = $value->sp_mtr;
          $modul->ndem = $value->ndem;
          $modul->id_biaya = $id_biaya;
          $modul->sp_mtr_150 = $value->sp_mtr_150;
          $modul->biaya_akhir = $value->biaya_akhir;

          $modul->save();
            // $this->info($value->biaya_akhir);
            // print_r($biaya);
          }
        }


        $bar->finish();
    }

}
