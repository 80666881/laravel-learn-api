<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::group(['prefix'=>'api/v1'],function (){
//    Route::resource('lessons','LessonsController');
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('user/login','AuthController@authenticate');//返回token
        $api->post('user/register','AuthController@register');
        $api->group(['middleware'=>'jwt.auth'],function($api){
            //根据token获取目前登录的用户
            $api->get('user/me','AuthController@getAuthenticatedUser');
            $api->get('lessons','LessonsController@index');
            $api->get('lessons/{id}','LessonsController@show');
        });
    });
});



//Route::auth();

//Route::get('/home', 'HomeController@index');
