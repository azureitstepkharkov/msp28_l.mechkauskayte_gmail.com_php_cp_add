<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('tasks', 'TaskController');
Route::resource('contactTypes', 'ContactTypeController');
Route::resource('technologies', 'TechnologyController');

/*мои роуты*/
Route::resource('projects', 'ProjectController');
Route::post('projects/create', 'ProjectController@store');
Route::delete('projects', 'ProjectController@destroy');
Route::post('projects/{id}/edit','ProjectController@update');
Route::get('projects/{id}/addMember','ProjectController@showProgrammers');
Route::get('showProfile/',array('uses' => 'UserController@showProfile', 'as' => 'users.showProfile'));
/*мои роуты*/

//Route::middleware(["rolespermissionsverifier:roles:Admin;User|permissions:adminperm"])->group(function (){
//    Route::resource('users', 'UserController');
//    Route::resource('roles', 'RoleController');
//    Route::resource('permissions', 'PermissionController');
//    Route::resource('technologies', 'TechnologyController');
//    Route::resource('tasks', 'TaskController');
//});
//
//Route::middleware(["rolespermissionsverifier:roles:Admin;User|permissions:EditProfile"])->group(function (){
//    Route::resource('uses', 'UserController', ['only' => [
//        'edit', 'update', 'showProfile'
//    ]]);
//});
//
//Route::middleware(["rolespermissionsverifier:roles:Admin;User|permissions:ClientSee"])->group(function (){
//    Route::resource('users', 'UserController', ['only' => [
//        'index'
//    ]]);
//});
//
//Route::middleware(["rolespermissionsverifier:roles:Admin;User|permissions:attachTechnologies"])->group(function (){
//    Route::resource('technologies', 'TechnologyController', ['only' => [
//        'index', 'create', 'edit', 'update'
//    ]]);
//});
//
//Route::middleware(["rolespermissionsverifier:roles:ProjectMan;"])->group(function (){
//    Route::resource('users', 'UserController', ['only' => [
//        'showEmployees', 'showClients'
//    ]]);
//});

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
# Проверяем, что у пользователя выбран доступный язык
        Session::put('locale', $locale);
# И устанавливаем его в сессии под именем locale
    }
    return redirect()->back();
# Редиректим его <s>взад</s> на ту же страницу
});

Route::put('inactive/{id}',array('uses' => 'UserController@inactive', 'as' => 'users.inactive'), function ($id){

});

Route::get('showEmployees/',array('uses' => 'UserController@showEmployees', 'as' => 'users.showEmployees'));
Route::get('showClients/',array('uses' => 'UserController@showClients', 'as' => 'users.showClients'));
Route::get('showProgrammers/',array('uses' => 'UserController@showProgrammers', 'as' => 'users.showProgrammers'));

//Route::middleware(["rolespermissionsverifier:roles:Admin|Client;User|permissions:TaskAddSeeEdit"])->group(function (){
//    Route::resource('tasks', 'TaskController', ['only' => [
//        'create', 'edit', 'update', 'store', 'destroy', 'showTask', 'show'
//    ]]);
//});

//ПЕРЕДЕЛАТЬ, ТАК НЕ РАБОТАЕТ КАРТОЧКА ЗАДАЧИ
Route::get('showTask/{id}',array('users' => 'TaskController@showTask', 'as' => 'tasks.showTask'), function ($id){

});

Route::post('tasks/{id}/attach_technology','TaskController@attach_technology');

Route::delete('tasks/{id}/detach_technology/{tech_id}', 'TaskController@detach_technology')->name('tasks.detach_technology');
Route::get('events', 'TaskController@showCalendar');
Route::get('events', 'TaskController@showCalendar') ->name('myEvents');
Route::get('avatars', 'UserController@showEditAvatar');
