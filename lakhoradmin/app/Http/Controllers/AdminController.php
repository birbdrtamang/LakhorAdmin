<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Passengers;
use App\Models\Driversinfo;
use App\Models\Drivers;
use App\Models\Localroute;
use App\Models\Routeaccepted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    protected $table = 'users';

    function Homepage(){
        $location =  'GCIT';
        $destination =  'Babesa';

        $price = Localroute::where('pickup', $location)
                ->where('destination', $destination)
                ->pluck('fare')
                ->first();

        return view('homepage',compact('price'));
    }

    function login(){
        if(Auth::check()){
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
            if($count >= 1000){
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

            return redirect(route('dashboard',compact('admin','totalfare','totalWeeklyFare','countPassenger','countDriver')));
        }
        return view('login');
    }

    // login
    function loginPost(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $currentUser = $user->name;
            Session::put('currentUser', $currentUser);
            $admin = User::get();

            // fetch driver reports
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
             if($count >= 1000){
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

            return redirect()->route('dashboard',compact('admin','totalfare','totalWeeklyFare','countPassenger','countDriver'));
        }
        return redirect()->route('login')->with("error", "Login details are not valid");

    }
    // logout
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    // add drivers 
    function addDriver(Request $request){
        $details = new Driversinfo();

        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:2048', // adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Process the uploaded CSV file
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');

            $path = $file->storeAs('csv', $file->getClientOriginalName());

            $details->name = $request->name;
            $details->licencenumber = $request->licenceNo;
            $details->cid = $request->cid;
            $details->gender = $request->gender;
            $details->mobilenumber = $request->phoneNo;
            $details->vehiclenumber = $request->vehicleNo;
            $details->vehiclebrand = $request->brand;
            $details->vehiclecolor = $request->color;
            $details->vehicletype = $request->type;
            $details->vehiclecapacity = $request->capacity;
            $details->filename = $path;

            $details->save();
            return back()->with("success","The driver details is added successfully!");
        }
        return redirect()->back()->with('error', 'No file uploaded.');

    }

    // add routes 
    function addRoute(Request $request){
        $route = new Localroute();

        date_default_timezone_set('Asia/Thimphu');
        $date = Carbon::now();
        $formattedDate = Carbon::parse($date)->toDateString();

        $route->pickup = $request->from;
        $route->destination = $request->destination;
        $route->fare = $request->fare;
        $route->date = $formattedDate;

        $route->save();
        return back()->with("success","New route added successfully!");
    }

    // get drivers report
    function driversReport(){
        $driversinfo = Driversinfo()->get();
        return back()->with("success","New route added successfully!");
    }

    // view driver report 
    function viewReport($cid){
        $currentDate = Carbon::now()->toDateString();

        $report = Routeaccepted::where('d_cid', $cid)
                ->whereDate('date','=', $currentDate)
                ->get();
        
        // get total fare per day 
        $totalfare = $report->sum('fare');

        return view('report',compact('report','totalfare'));
    }

    function seePrice(Request $request){
        $location =  $request->location;
        $destination =  $request->destination;

        $price = Localroute::where('pickup', $location)
                ->where('destination', $destination)
                ->pluck('fare')
                ->first();

        return view('homepage',compact('price'));
    }
}
