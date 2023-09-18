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

Route::post("/payment_input","App\Http\controllers\HomeControler@payment_input");
Route::post("/rider_sign_up","App\Http\controllers\HomeControler@rider_sign_up");
Route::post("/login_request","App\Http\controllers\HomeControler@login_request");
Route::get("/show_all_packing_card","App\Http\controllers\HomeControler@show_all_packing_card")->middleware('login');
Route::get("/show_all_packing_card_by_search/{card_no}","App\Http\controllers\HomeControler@show_all_packing_card_by_search")->middleware('login');
Route::get("/handle_pick_up/{id}","App\Http\controllers\HomeControler@handle_pick_up")->middleware('login');
Route::get("/check_delivery/{id}","App\Http\controllers\HomeControler@check_delivery")->middleware('login');
Route::get("/check_return/{id}","App\Http\controllers\HomeControler@check_return")->middleware('login');
Route::get("/my_picked_card","App\Http\controllers\HomeControler@my_picked_card")->middleware('login');
Route::get("/card_register/{regi_no}","App\Http\controllers\HomeControler@card_register")->middleware('login');
Route::get("/my_picked_card_by_search/{card_no}","App\Http\controllers\HomeControler@my_picked_card_by_search")->middleware('login');


//Views Route 
Route::get('/login', function () {
    return view("Pages.login");
});

Route::get('/signup',function(){
    return view("Pages.signup");
});

Route::get('/', function () {
    return view("Pages.home");
})->middleware('login');


Route::get('/delivery_status', function () {
    return view("Pages.delivery_status");
})->middleware('login');
