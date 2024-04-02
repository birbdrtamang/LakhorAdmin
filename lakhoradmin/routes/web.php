<?php

use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use App\Models\Driversinfo;
use App\Models\Drivers;
use App\Models\Passengers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use Carbon\Carbon;
use App\Models\Routeaccepted;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [AdminController::class,'Homepage'])->name('homepage');

Route::get('/admin-login', [AdminController::class,'login'])->name('login');
Route::post('/login', [AdminController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::post('/check-price', [AdminController::class, 'seePrice'])->name('seeprice.post');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/dashboard', function () {
        $admin = Auth::user();

        $currentDate = Carbon::now()->toDateString();

        $report = Routeaccepted::whereDate('date','=', $currentDate)
                ->get();
        // get total fare per day 
        $fare = $report->sum('fare');

        // inflow 
        if($fare >= 10000){
            $totalfare = number_format($fare/1000,1).'K';
        }
        elseif($fare >= 1000000){
            $totalfare = number_format($fare/1000000,1).'M';
        }
        else{
            $totalfare = $fare;
        }

        // weekly total fare 
        // Calculate the start and end dates of the current week
        $startDate = Carbon::now()->startOfWeek()->toDateString();
        $endDate = Carbon::now()->endOfWeek()->toDateString();
        // Calculate the total weekly fare
        $totalWeeklyFare = Routeaccepted::whereBetween('date', [$startDate, $endDate])
                        ->sum('fare');

        // get no. of passengers 
        $count = Passengers::count();
        // inflow 
        if($count >= 10000){
            $countPassenger = number_format($count/1000,1).'K';
        }
        elseif($count >= 1000000){
            $countPassenger = number_format($count/1000000,1).'M';
        }
        else{
            $countPassenger = $count;
        }

        // get no. of drivers 
        $count_d = Drivers::count();
        // inflow 
        if($count_d >= 10000){
            $countDriver = number_format($count_d/1000,1).'K';
        }
        elseif($count_d >= 1000000){
            $countDriver = number_format($count_d/1000000,1).'M';
        }
        else{
            $countDriver = $count_d;
        }


        return view('dashboard',compact('admin','totalfare','totalWeeklyFare', 'countPassenger','countDriver'));

    })->name('dashboard');

    Route::get('/add-driver', function () {
        return view('addDriver');
    })->name('driverform');

    // view drivers info
    Route::get('/driver-report', function () {
        $info = Driversinfo::all();
        return view('driverReport',compact('info'));
    })->name('driverreport');
    
    // view report 
    Route::get('/view-report/{cid}',[AdminController::class, 'viewReport'])->name('viewreport');

    Route::get('/add-routes', function () {
        return view('addRoutes');
    })->name('addroutes');

    

    // add driver details 
    Route::post('/add-Driver', [AdminController::class, 'addDriver'])->name('addDriver.post');
    Route::post('/add-Route', [AdminController::class, 'addRoute'])->name('addRoute.post');



});