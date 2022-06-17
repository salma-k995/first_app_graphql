<?php

use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Notifications\TestNotification;
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

    //   return User::find(1);
   
   /*  $user= User::create([
        'name'=>'SAalma',
        'email'=>'salmak9219@gmail.com',
        'password'=>bcrypt('123456789')
    ]);

    $user->notify(new TestNotification()); */
    return new UserCollection((User::all()));
    return view('welcome');
});

