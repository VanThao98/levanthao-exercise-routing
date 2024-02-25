<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// mission 5
route::prefix('user') -> group(function(){

    //mission 2
    route::get('/user',function(){
        global $users;
        return $users;
    });

    // mision 3
    route::get('/user/{userIndex}',function($userIndex){
        global $users;
        foreach ($users as $index => $value) {
            if($userIndex == $index){
                return $value;
            }
        }
        return 'cannot find the user with index '.$userIndex;
    }) -> where (['userIndex' => '[0-9]+']);

    //mission 4

    route::get('/user/{userName}', function($userName){
        global $users;
        foreach ($users as $user) {
            if($userName == $user['name']){
                return $user;
            }
        }
        return 'cannot find the user name with '.$userName;
    }) -> where (['userName' => '[a-zA-Z]+']);

    //fall back route
    route::get('/{any}', function(){
        return 'You cannot get a user like this !';
    })->where('any', '.*');
});

//mission 6
route::get('/users/{userIndex}/posts/{postIndex}', function ($userIndex, $postIndex) {
    global $users;

    if(isset($users[$userIndex])){
        $users = $users[$userIndex];

        if(isset($users['posts'][$postIndex])){
            return $users['posts'][$postIndex];
        }
        else{
            return 'The post of index '.$postIndex.' for the user '. $userIndex;
        }
    }
    else{
        return 'cannot find user with '.$userIndex;
    }
})-> where (['userIndex' => '[0-9]+', 'postIndex' => '[0-9]+']);