<?php

use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\LocationController;
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

Route::get("/images/{image_path}", [LocationController::class, "findImageByName"]); //get an image by name

Route::get("/locations/most-locations", [LocationController::class, "mostLocations"]);

Route::get("/cities", [LocationController::class, "allCities"]);

//Route::middleware(['auth:sanctum','verified', 'language'])->group(function () {
Route::middleware(['language'])->group(function () {
    //Locations routes
    Route::get("/locations", [LocationController::class, "all"]); //only show language dependant data on detail request
    Route::get("/locations/{id}", [LocationController::class, "find"]);

    Route::post("/locations", [LocationController::class, "add"])->middleware(['isAdmin']);

    Route::put("/locations/{id}", [LocationController::class, "update"]);

    Route::delete("/locations/{id}", [LocationController::class, "delete"]);

    Route::get("/locations-city/{city}", [LocationController::class, "findByCity"]);

    //Favourites routes
    Route::get('/favourites/{id}', [FavouriteController::class, 'findByUser']);
    Route::post('/favourites', [FavouriteController::class, 'add']);
    Route::delete('/favourites/{user_id}/{location_id}', [FavouriteController::class, 'delete']);

    //Owners routes
    Route::get('/owners/{id}', [OwnerController::class, 'findByUser']);
    Route::post('/owners', [OwnerController::class, 'add']);
    Route::delete('/owners/{user_id}/{location_id}', [OwnerController::class, 'delete']);
});
