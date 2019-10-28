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

use App\User;
use App\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {

    $user = User::findOrFail(1);

    $user->roles()->save(new Role(['name' => 'Subscriber']));

});

Route::get('/read', function () {

    $user = User::findOrFail(1);

    foreach ($user->roles as $role) {

        echo $role->name . " <br />";
    }
});

Route::get('/update', function () {

    $user = User::findOrFail(1);

    if ($user->has('roles')) {

        foreach($user->roles as $role) {

            if($role->name == 'Administrator') {
                $role->name = 'administrator';

                $role->save();
            }
        }

    }

});

Route::get('/delete', function () {

    $user = User::findOrFail(1);

    //$user->roles()->delete();

    if($user->has('roles')) {

        foreach ($user->roles as $role) {

            $role->whereId(4)->delete();
        }
    }
});

Route::get('attach', function () {

    $user = User::findOrFail(1);

    $user->roles()->attach(5);

});

Route::get('detach', function () {

    $user = User::findOrFail(1);

    $user->roles()->detach();
});

Route::get('/sync', function () {

    $user = User::findOrFail(1);

    $user->roles()->sync([3, 5]);

});








