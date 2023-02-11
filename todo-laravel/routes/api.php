<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/tokens/create', function (Request $request) {

    if(Auth::attempt(['email' => $request->username, 'password' => $request->password])) {

        $payload['token'] =  $request->user()->createToken('MyApp')->plainTextToken;

        return response()->json(['result' => $payload]);

    }

    return response()->json(['error'=>'Unauthorised'], 401);
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});


Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'storeTodo']);
Route::delete('/todo/{id}/delete', [TodoController::class, 'deleteTodo']);
Route::put('/todo/{id}/done', [TodoController::class, 'doneTodo']);
