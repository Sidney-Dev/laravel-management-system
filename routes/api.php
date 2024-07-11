<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Http;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('test', function() {
    return response()->json([
        'success' => true
    ]);
});

Route::post('/login', function(Request $request) {

    $request_url = env('APP_URL') . '/oauth/token';

    $response = Http::asForm()->post($request_url, [
        'grant_type' => 'password',
        'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
        'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
        'username' => $request->email,
        'password' => $request->password,
        'scope' => '',
    ]);
     
    return $response->json();

    // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //     $user = Auth::user();

    //     $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
    //         'grant_type' => 'password',
    //         'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
    //         'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
    //         'username' => $request->email,
    //         'password' => $request->password,
    //         'scope' => '',
    //     ]);

    //     $user['token'] = $response->json();

    //     return response()->json([
    //         'success' => true,
    //         'statusCode' => 200,
    //         'message' => 'User has been logged successfully.',
    //         'data' => $user,
    //     ], 200);
    // } else {
    //     return response()->json([
    //         'success' => false,
    //         'statusCode' => 401,
    //         'message' => 'Unauthorized.',
    //         'errors' => 'Unauthorized',
    //     ], 401);
    // }
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/refresh', [AuthController::class, 'refreshToken']);

Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

});