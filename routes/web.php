<?php

use Zttp\Zttp;

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
    return view('welcome');
});

Route::get('/todos', function () {
    $client = new GuzzleHttp\Client();
    $response = $client->request('GET', 'http://ulp-guzzle.test/api/todos');

    $todos =  json_decode($response->getBody(), true);

    return view('index', [
        'todos' => $todos
    ]);
});

Route::get('/ztodos', function () {
    $response = Zttp::get('http://ulp-guzzle.test/api/todos');

    $todos = $response->json();

    return view('index', [
        'todos' => $todos
    ]);
});

Route::get('/create', function () {
    $client = new GuzzleHttp\Client();
    $response = $client->request('POST', 'http://ulp-guzzle.test/api/todos', [
        'form_params' => [
            'title' => 'Adding a new todo',
            'completed' => 0
        ]
    ]);

    $todo =  json_decode($response->getBody(), true);

    return $todo;
});

Route::get('/zcreate', function () {
    $response = Zttp::post('http://ulp-guzzle.test/api/todos', [
        'title' => 'Add from ZTTP',
        'completed' => 0,
    ]);

    return $response->json();
});

Route::get('/update', function () {
    $client = new GuzzleHttp\Client();
    $response = $client->request('PATCH', 'http://ulp-guzzle.test/api/todos/2', [
        'form_params' => [
            'title' => 'UPDATED',
            'completed' => 1
        ]
    ]);

    $todo = json_decode($response->getBody(), true);

    return $todo;
});

Route::get('/zupdate', function () {
    $response = Zttp::patch('http://ulp-guzzle.test/api/todos/3', [
        'title' => 'Updated',
        'completed' => 1,
    ]);

    return $response->json();
});

Route::get('/delete', function () {
    $client = new GuzzleHttp\Client();
    $response = $client->request('DELETE', 'http://ulp-guzzle.test/api/todos/2');

    $todo = json_decode($response->getBody(), true);

    return $todo;
});

Route::get('/zdelete', function () {
    $response = Zttp::delete('http://ulp-guzzle.test/api/todos/3');

    return $response->json();
});
