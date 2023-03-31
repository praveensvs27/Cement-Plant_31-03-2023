<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantGroupController;
use App\Http\Controllers\PlantTypeController;
use App\Http\Controllers\PlantCompanyController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\Map1Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/Group', 'group');
Route::get('/Group-count',[PlantGroupController::class, 'count']);
Route::get('/Group-retrieve',[PlantGroupController::class, 'retrieve']);
Route::get('/Group-insert',[PlantGroupController::class, 'insert']);
Route::get('/Group-update',[PlantGroupController::class, 'update']);
Route::get('/Group-delete',[PlantGroupController::class, 'delete']);

Route::view('/Plant_Type', 'plant_type');
Route::get('/Plant_Type-count',[PlantTypeController::class, 'count']);
Route::get('/Plant_Type-retrieve',[PlantTypeController::class, 'retrieve']);
Route::get('/Plant_Type-insert',[PlantTypeController::class, 'insert']);
Route::get('/Plant_Type-update',[PlantTypeController::class, 'update']);
Route::get('/Plant_Type-delete',[PlantTypeController::class, 'delete']);

Route::get('/Company',[PlantCompanyController::class, 'company']);
Route::get('/Company-count',[PlantCompanyController::class, 'count']);
Route::get('/Company-retrieve',[PlantCompanyController::class, 'retrieve']);
Route::get('/Company-insert',[PlantCompanyController::class, 'insert']);
Route::get('/Company-update',[PlantCompanyController::class, 'update']);
Route::get('/Company-delete',[PlantCompanyController::class, 'delete']);

Route::get('/Plant',[PlantController::class, 'plant']);
Route::get('/Plant-count',[PlantController::class, 'count']);
Route::get('/Plant-retrieve',[PlantController::class, 'retrieve']);
Route::get('/Plant-insert',[PlantController::class, 'insert']);
Route::get('/Plant-update',[PlantController::class, 'update']);
Route::get('/Plant-delete',[PlantController::class, 'delete']);

Route::view('/Map1','map1');
Route::get('/Map1',[Map1Controller::class, 'map1']);
