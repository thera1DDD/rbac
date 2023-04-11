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
    });

    Route::group(['prefix' => 'course'], function (){
        Route::get('/','CourseController@index')->name('course.index');
        Route::get('/create','CourseController@create')->name('course.create');
        Route::post('/','CourseController@store')->name('course.store');
        Route::get('/{course}/edit',"CourseController@edit")->name('course.edit');
    });


//    //course
//    Route::resource('course','CourseController');
//    //
    //users
    Route::resource('user', 'UserController');
    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');
    //

});


Auth::routes();


    //////////////////////////////// axios request for course
//
//    Route::get('/getAllPermission', 'PermissionController@getAllPermissions');
//    Route::post("/postRole", "CourseController@store");
//    Route::get("/getAllCourses", "CourseController@getAll");
//    Route::get("/getAllRoles", "CourseController@getAll");
//    Route::get("/getAllPermissions", "PermissionController@getAll");
//
//    /////////////axios create course
//    Route::post('/account/create', 'UserController@store');
//    Route::put('/account/update/{id}', 'UserController@update');
//    Route::delete('/delete/user/{id}', 'UserController@delete');
//    Route::get('/search/user', 'UserController@search');
//


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
