<?php


use App\Teach\User\Constant\RoleConstant;

Route::get('/home', 'HomeController@index');


Route::group(['middleware' => 'role:'. RoleConstant::ADMIN_ROLE_NAME], function (){
    Route::get('/test', function(){
       dd("test");
    });
});