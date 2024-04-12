<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use HomeNet\RouterosApi\RouterAPI;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|1');
    $hotspotisolation = $routerApi->setHotspotIsolation('*1', 
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('tes', function () {
    $routerApi = RouterAPI::make('10.70.108.166', 'admin', 'RexusBattlefire');

    //cek waktu uptime dalam waktu second (detik)
    // $test = $routerApi->uptime();
    // $formattedUptime = convertMikrotikTimeToSecond($test);

    //cek status isolasi enable atau disable
    // $isolation = $routerApi->isIsolationHotspotEnable();

    //print data hotspot
    // $hotspot = $routerApi->hotspotServers();

    // //print data interfaces
    // $interface = $routerApi->interfaces();

    //pake paramater $namainterface $duration (durasi)
    $trafficinterface = $routerApi->trafficmonitor('wlan1', 5);

    //pake parameter $host (nama host/tujuan ping)
    // $ping = $routerApi->ping('www.google.com', '5');

    //untuk mengubah status isolasi hotspot dengan menggunakan boolean false/true
    // $isolationChange = $routerApi->setHotspotIsolation(false);

    dd($trafficinterface);
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
