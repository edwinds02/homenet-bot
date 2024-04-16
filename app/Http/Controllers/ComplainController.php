<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complain;
use HomeNet\RouterosApi\RouterAPI;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ComplainController extends Controller
{
    public function storeFromWebhook(Request $request)
    {
        $routerApi = RouterAPI::make('10.70.108.166', 'admin', 'RexusBattlefire');

        $request->validate([]);
        // dd($request->account);

        $this->storeToDatabase($request);

        $content = $request->content;

        //Cek content gangguan
        if (strripos($content, 'lambat') !== false) {

            //Konfigurasi host dan jumlah ping
            $host = 'www.google.com';
            $count = '5';

            //Menghitung rata-rata ping
            $hostRoute = $routerApi->ping($host, $count);
            $avgping = avgPing($hostRoute);

            //Jika ping diatas 100ms kirimkan webhook
            if ($avgping >= 20) {

                //tujuan/url webhook
                $response = Http::post('https://discord.com/api/webhooks/1229235474271567954/zwzr9RlykdsNkGx5Qu0wbEnqiBbuUttf-6hCvnX1iAAhdAdNI9ECO_LdIDU_o7dkh3oE', [
                    'content' => 'Ping tinggi silahkan restart device',
                    'embeds' => [
                        [
                            'title' => 'Ping terlihat tidak stabil',
                            'description' => 'avg = ' . $avgping,
                            'color' => '15548997',
                        ]
                    ],
                ]);

                if ($response->successful()) {
                    return 'Ping tinggi, mengirim notifikasi';
                } else {
                    return 'Ada kesalahan saat mengirim notifikasi: ' . $response->body();
                }
            } else {

                //Jika ping lebih rendah dari 100ms, mengirim webhook juga
                $response = Http::post('https://discord.com/api/webhooks/1229235474271567954/zwzr9RlykdsNkGx5Qu0wbEnqiBbuUttf-6hCvnX1iAAhdAdNI9ECO_LdIDU_o7dkh3oE', [
                    'content' => 'Perangkatnya sudah didaftarkan belum?',
                    'embeds' => [
                        [
                            'title' => 'Ping terlihat stabil',
                            'description' => 'avg = ' . $avgping,
                            'color' => '5763719',
                        ]
                    ],
                ]);

                if ($response->successful()) {
                    // $this->storeToDatabase($request);
                    return 'Ping stabil, mengirim notifikasi';
                } else {
                    return 'Ada kesalahan saat mengirim notifikasi: ' . $response->body();
                }
            }
        } else {
            //jika tidak ditemukan respon yang sesuai
            return 'Response tidak ditemukan';
        }
    }

    //Fungsi untuk simpan payload webhook ke database
    public function storeToDatabase(Request $request)
    {
        $request->validate([]);

        DB::table('webhook_data')->insert([
            'body' =>  json_encode($request->all()),
        ]);

        return response()->json(['message' => 'Data komplain berhasil disimpan'], 200);
    }
}
