<?php

use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get("/images/{image_path}", [LocationController::class, "findImageByName"]); //get an image by name
Route::get("/cities", [LocationController::class, "allCities"]);
Route::get("/locations/{id}", [LocationController::class, "find"])->middleware(['language']);
Route::get("/locations-city/{city}", [LocationController::class, "findByCity"]);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return auth()->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/favourites', [FavouriteController::class, 'findByUser']);

    Route::post('/favourites/{location_id}', [FavouriteController::class, 'add']);
    Route::delete('/favourites/{location_id}', [FavouriteController::class, 'delete']);
});

Route::middleware(['isAdmin'])->group(function () {
    Route::get("/locations", [LocationController::class, "all"]);
    Route::get('locations/languages/{id}', [LocationController::class, 'getAllLanguages']);
    Route::post("/locations", [LocationController::class, "add"]);
    Route::put("/locations/{id}", [LocationController::class, "update"]);
    Route::delete("/locations/{id}", [LocationController::class, "delete"]);

    Route::get('/owners', [OwnerController::class, 'findByUser']);
});

Route::middleware(['isDeveloper'])->group(function () {
    Route::get('/users', [UserController::class, 'all']);
    Route::get('/admins', [UserController::class, 'admins']);
    Route::get('/developers', [UserController::class, 'developers']);
});
