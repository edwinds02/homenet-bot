<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complain;
use Illuminate\Support\Facades\DB;

class ComplainController extends Controller
{
    public function storeFromWebhook(Request $request)
    {
        $request->validate([]);

        DB::table('webhook_data')->insert([
            'body' =>  json_encode($request -> all()),
        ]);

        return response()->json(['message' => 'Data komplain berhasil disimpan'], 200);
    }
}
