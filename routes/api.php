<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\ComplainController;

Route::post('/webhook/pingtalk', [ComplainController::class, 'storeFromWebhook']);
// Route::post('/webhook/pingtalktes', [ComplainController::class, 'cantConnectSite']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
