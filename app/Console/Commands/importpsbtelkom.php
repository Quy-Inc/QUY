<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Modules\psbta\models\Psbtelkom;
use Excel;
use \Carbon\Carbon;
// use Illuminate\Support\Facades\Config;
class importpsbtelkom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:telkom {data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data PSB Telkom';

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
      $lokasifile = public_path().'/files/import/'.$this->argument('data');
      Excel::load($lokasifile, function($reader) {})
        ->chunk(5000,function($x){
          foreach ($x as $dataPSB) {
              $modul = new Psbtelkom;
              $modul->ndem = $dataPSB->ndem;
              $modul->ncli = $dataPSB->ncli;
              $tgl_re = Carbon::parse($dataPSB->tgl_re);
              $modul->tgl_re = $tgl_re;
              $tgl = Carbon::parse($dataPSB->tgl);
              $modul->tgl = $tgl;
              $modul->nd_speedy = (int)$dataPSB->nd_speedy;
              $modul->nd = $dataPSB->nd;
              $modul->kcontact = (String)$dataPSB->kcontact;
              $modul->nom = $dataPSB->nom;
              $modul->sto = $dataPSB->sto;
              $modul->datel = $dataPSB->datel;
              $modul->witel = $dataPSB->witel;
              $modul->kawasan = $dataPSB->kawasan;
              $modul->status = $dataPSB->status;
              $modul->pack = $dataPSB->pack;
              $modul->save();
              echo $dataPSB->ndem." OK"."\n";
          }
        });
    }
}
