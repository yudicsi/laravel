<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;


include str_replace("\\","/",base_path('app/__aaa/fungsi.php'));

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $_SESSION['USER_LVL']=0;
        $ss=strtolower(env('APP_NAME'));
        $i=strripos($ss,'_');

        if (! $i) {
          $_SESSION['APP_DIR'] = str_replace("\\","/",base_path($ss)); }
        else {
          $s=Left($ss,$i); 
          $_SESSION['APP_DIR'] = str_replace("\\","/",base_path('app/_'.$s));
          if (file_exists($_SESSION['APP_DIR'].'/Company.json')) {    
             $Cab=substr($ss,$i+1); 
             $json_string = file_get_contents($_SESSION['APP_DIR'] .'/Company.json',1);
             $json = json_decode($json_string, true);    
             $_SESSION['APP_NAME']=$s;
             $_SESSION['APP_PATERN']=env('APP_PATERN', $s);
             $_SESSION['APP_DATE']=Carbon::now();
             $_SESSION['APP_PRD']=substr($_SESSION['APP_DATE']->toDateString(),0,7);
             $_SESSION['APP_DB']=$ss.substr($_SESSION['APP_PRD'],0,4);
             $_SESSION['APP_COMPANY']=$json["name"];
             $_SESSION['APP_KDCAB']=$json["branch"][$Cab]["kdcab"];
             $_SESSION['APP_NMCAB']=$json["branch"][$Cab]["nmcab"];
             View::addNamespace('PATERN', $_SESSION['APP_DIR'] .'/views');
             View::addNamespace('AAA', str_replace("\\","/",base_path('app/__aaa/views')));
             View::addNamespace('STOCK', str_replace("\\","/",base_path('app/__stock/views')));
             Config::set("database.connections.mysql", [
               'driver' => 'mysql',
               "host" => $json["branch"][$Cab]["host"],
               "database" => $_SESSION['APP_PATERN'],
               "username" => $json["branch"][$Cab]["userdb"],
               "password" => $json["branch"][$Cab]["pwddb"],
               "port" => $json["branch"][$Cab]["port"],
               'charset'   => 'utf8',
               'collation' => 'utf8_unicode_ci',
               'prefix'    => '',
               'strict'    => false,
               'options'   => [\PDO::ATTR_EMULATE_PREPARES => true]
             ]);
          }
        }
    }
}