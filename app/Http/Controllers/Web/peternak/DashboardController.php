<?php

namespace App\Http\Controllers\Web\peternak;

use App\Http\Controllers\Controller;
use App\Models\DataSensors;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index(){

        $DataSensor = DataSensors::orderBy('created_at', 'desc')->take(5)->get()->reverse();
        $log= Activity::all();
        return view('peternak.dashboard', [
            'DataSensor'=> $DataSensor,
            'Log'=> $log
        ]);
    }
}
