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
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    Route::get('/profile', 'UserController@profile')->name('user.profile');

    Route::post('/profile', 'UserController@postProfile')->name('user.postProfile');

    Route::get('/password/change', 'UserController@getPassword')->name('userGetPassword');

    Route::post('/password/change', 'UserController@postPassword')->name('userPostPassword');
});


Route::group(['middleware' => ['auth', 'role_or_permission:admin|create role|create permission']], function() {

    Route::group(['prefix' => 'language'], function (){
        Route::get('/','LanguageController@index')->name('language.index');
        Route::get('/create','LanguageController@create')->name('language.create');
        Route::post('/','LanguageController@store')->name('language.store');
        Route::get('/{language}/edit',"LanguageController@edit")->name('language.edit');
        Route::patch('{language}',"LanguageController@update")->name('language.update');
        Route::delete('{language}',"LanguageController@delete")->name('language.delete');
    });

    Route::group(['prefix' => 'course'], function (){
        Route::get('/','CourseController@index')->name('course.index');
        Route::get('/create','CourseController@create')->name('course.create');
        Route::post('/','CourseController@store')->name('course.store');
        Route::get('/{course}/edit',"CourseController@edit")->name('course.edit');
        Route::patch('{course}',"CourseController@update")->name('course.update');
        Route::delete('{course}',"CourseController@delete")->name('course.delete');
        Route::get('/{course}',"CourseController@play")->name('course.play');
    });

    Route::group(['prefix' => 'module'], function (){
        Route::get('/','ModuleController@index')->name('module.index');
        Route::get('/create','ModuleController@create')->name('module.create');
        Route::post('/','ModuleController@store')->name('module.store');
        Route::get('/{module}/edit',"ModuleController@edit")->name('module.edit');
        Route::patch('{module}',"ModuleController@update")->name('module.update');
        Route::delete('{module}',"ModuleController@delete")->name('module.delete');
    });

    Route::group(['prefix' => 'video'], function (){
        Route::get('/','VideoController@index')->name('video.index');
        Route::get('/create','VideoController@create')->name('video.create');
        Route::post('/','VideoController@store')->name('video.store');
        Route::get('/{video}/edit',"VideoController@edit")->name('video.edit');
        Route::patch('{video}',"VideoController@update")->name('video.update');
        Route::delete('{video}',"VideoController@delete")->name('video.delete');
        Route::get('/{video}',"VideoController@play")->name('video.play');
    });



    Route::resource('user', 'UserController');
    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');

});


Auth::routes();
//////////////////////////////// axios request for user

Route::get('/getAllPermission', 'PermissionController@getAllPermissions');
Route::post("/postRole", "RoleController@store");
Route::get("/getAllUsers", "UserController@getAll");
Route::get("/getAllRoles", "RoleController@getAll");
Route::get("/getAllPermissions", "PermissionController@getAll");

/////////////axios create user
Route::post('/account/create', 'UserController@store');
Route::put('/account/update/{id}', 'UserController@update');
Route::delete('/delete/user/{id}', 'UserController@delete');
Route::get('/search/user', 'UserController@search');
