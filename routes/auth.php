<?php


use App\Teach\User\Constant\PermissionConstant;
use App\Teach\User\Constant\RoleConstant;

Route::get('/home', 'HomeController@index')->name('dashboard');


// https://laravel.com/docs/master/controllers#resource-controllers
Route::get('/articles', 'ArticleController@index')->name('articles:index');
Route::get('/articles/create', 'ArticleController@create')->name('articles:create');
Route::post('/articles', 'ArticleController@store')->name('articles:store');
Route::get('/articles/{article_id}', 'ArticleController@show')->name('articles:show');
Route::get('/articles/{article_id}/edit', 'ArticleController@edit')->name('articles:edit');
Route::put('/articles/{article_id}', 'ArticleController@update')->name('articles:update');
Route::delete('/articles/{article_id}', 'ArticleController@destroy')->name('articles:destroy');
//Route::resource('articles', 'ArticleController');





Route::group(['middleware' => 'role:'. RoleConstant::ADMIN_ROLE_NAME], function (){
    Route::get('/test', function(){
       dd("test");
    });
});
