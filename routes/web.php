<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $jokeApiRequest = 'https://v2.jokeapi.dev/joke/Programming?blacklistFlags=nsfw,religious,political,racist,sexist,explicit&type=twopart';
    $client = new GuzzleHttp\Client();
    $response = $client->get($jokeApiRequest);
    $joke = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
    if (isset($joke['error']) && $joke['error'] !== true) {
        $viewData = compact('joke');
    } else {
        $viewData = ['joke' => false];
    }
    return view('home', $viewData);
});
