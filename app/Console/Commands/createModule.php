<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class createModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:module {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
	$module = $this->argument('module');
    $modulModels = ucwords($module);
    //echo $module;
    $mkdirModule = (File::exists('module/'.$module))?"1":File::makeDirectory('module/'.$module, 0755, true);
    $mkdirModuleModels = (File::exists('module/'.$module.'/models'))?"1":File::makeDirectory('module/'.$module.'/models', 0755, true);
    $mkdirModuleView = (File::exists('module/'.$module.'/view'))?"1":File::makeDirectory('module/'.$module.'/view', 0755, true);
    
    //create app
    $appBladePhp = File::get('moduleTemplates/app.blade.php');
    $createAppBlade = File::put('module/'.$module.'/app.blade.php',$appBladePhp);
    
    //create .conf
    $confFile = File::get('moduleTemplates/.conf');
    $confFile = str_replace('$module', $module, $confFile);
    $confFile = str_replace('$modulModels', $modulModels, $confFile);
    $createConf = File::put('module/'.$module.'/.conf',$confFile);
    
    //create home.blade.php
    $homeFile = File::get('moduleTemplates/home.blade.php');
    $homeFile = str_replace('$module', $module, $homeFile);
    $homeFile = str_replace('$modulModels', $modulModels, $homeFile);
    $createHome = File::put('module/'.$module.'/view/home.blade.php',$homeFile);

    //create add.blade.php
    $addFile = File::get('moduleTemplates/add.blade.php');
    $addFile = str_replace('$module', $module, $addFile);
    $addFile = str_replace('$modulModels', $modulModels, $addFile);
    $createAdd = File::put('module/'.$module."/view/add$module.blade.php",$addFile);

    //create edit.blade.php
    $editFile = File::get('moduleTemplates/edit.blade.php');
    $editFile = str_replace('$module', $module, $editFile);
    $editFile = str_replace('$modulModels', $modulModels, $editFile);
    $createEdit = File::put('module/'.$module."/view/edit$module.blade.php",$editFile);

    //create models.php
    $modelsFile = File::get('moduleTemplates/models.php');
    $modelsFile = str_replace('$module', $module, $modelsFile);
    $modelsFile = str_replace('$modulModels', $modulModels, $modelsFile);
    $createEdit = File::put('module/'.$module."/models/$modulModels.php",$modelsFile);

    //create controller.php
    $controllerFile = File::get('moduleTemplates/controller.php');
    $controllerFile = str_replace('$module', $module, $controllerFile);
    $controllerFile = str_replace('$modulModels', $modulModels, $controllerFile);
    $createController = File::put('module/'.$module."/controller.php",$controllerFile);

    //create notfound.blade.php
    $createNf = File::put('module/'.$module."/notfound.blade.php","");

    echo "Success\n\r";

    }
}
