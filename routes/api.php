<?php

use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Locations_languageController;
use App\Http\Controllers\OwnerController;
use Illuminate\Http\Request;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


//Route::middleware(['auth:sanctum','verified', 'language'])->group(function () {
    //Locations routes
    Route::get("/locations/{id}", [LocationController::class, "find"]);
    Route::get("/locations", [LocationController::class, "all"]); //only show language dependant data on detail request

    Route::post("/locations", [LocationController::class, "add"]);
    Route::post("/locations/language", [Locations_languageController::class, "add"]);

    Route::put("/locations/{id}", [LocationController::class, "update"]);
    Route::put("/locations/language/{id}", [Locations_languageController::class, "update"]);

    Route::delete("/locations/{id}", [LocationController::class, "delete"]);
    Route::delete("/locations/language/{location_id}", [Locations_languageController::class, "delete"]);

    Route::get("/locations/city", [LocationController::class, "findByCity"]);


    //Favourites routes
    Route::get('/favourites', [FavouriteController::class, 'findByUser']);
    Route::post('/favourites', [FavouriteController::class, 'add']);
    Route::delete('/favourites/{id}', [FavouriteController::class, 'delete']);

    //Owners routes
    Route::get('/owners', [OwnerController::class, 'findByUser']);
    Route::post('/owners', [OwnerController::class, 'add']);
    Route::delete('/owners/{id}', [OwnerController::class, 'delete']);
//});
