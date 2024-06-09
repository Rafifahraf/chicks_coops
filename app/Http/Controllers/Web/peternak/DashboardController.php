<?php

namespace App\Http\Controllers\Web\peternak;

use App\Http\Controllers\Controller;
use App\Models\ConfigLamp;
use App\Models\DataSensors;
use App\Models\ConfigHeater;
use App\Models\Devices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dataDevice = Devices::where('user_id', '=', Auth::id())->get();
        if ($request->query('device') != null) {
            $selected = $request->query('device');
        } else {
            if(count($dataDevice)>0){
                $selected = $dataDevice->first()->id;

            } else{
                return view('peternak.dashboardnodevice');
            }

        }
        $DataSensor = DataSensors::where('device_id', '=', $selected)->orderBy('created_at', 'desc')->take(5)->get()->reverse();
        $log = Activity::where('properties->device_id', '=', $selected)->orderBy('created_at', 'desc')->paginate(5);
        $heater = ConfigHeater::where('device_id', '=', $selected)->first();
        $lamp = ConfigLamp::where('device_id', '=', $selected)->first();
        return view('peternak.dashboard', [
            'DataSensor' => $DataSensor,
            'Log' => $log,
            'DataDevice' => $dataDevice,
            'HeaterConfig' => $heater,
            'LampConfig' => $lamp,
            'SelectedDevice'=> $selected
        ]);
    }
}
