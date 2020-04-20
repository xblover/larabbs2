<?php

use Illuminate\Http\Request;

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

Route::get('/get-demo', function () {
    getParams();
});

Route::post('/post-form-urlencode', function () {
    postFormUrlEncode();
});

Route::post('/post-form-data', function () {
    postFormData();
});

Route::post('/post-json', function () {
    postJson();
});

Route::get('/index', "Controller@index");

function getParams()
{
    $id = $_GET['id'];
    $name = $_GET['name'];

    echo $id. ' '.$name;
}

function postFormUrlEncode()
{
    $firstParam = $_POST['first_param'];
    $secondParam = $_POST['second_param'];

    echo $firstParam." ".$secondParam;
}

function postFormData()
{
    $firstParam = $_POST['first_param'];
    $secondParam = $_POST['second_param'];

    echo $firstParam." ".$secondParam;
}

function postJson()
{
    $res = file_get_contents("php://input");
    $resArr = json_decode($res,true);

    $firstParam = $resArr["first_param"];
    $second_param = $resArr["second_param"];

    echo $firstParam." ".$second_param;
}

Route::get('/user/login','JwtLoginController@login');

Route::middleware(['jwt_auth'])->group(function () {
    Route::get('/user/info','UserController@info');
    Route::get('/user/info-cache','UserController@infoWithCache');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
