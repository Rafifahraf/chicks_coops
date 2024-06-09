<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConfigLamp;
use Illuminate\Http\Request;
use App\Models\DataSensors;
use App\Models\ConfigHeater;
use Spatie\Activitylog\Models\Activity;

class APIDashboardController extends Controller
{
    public function index(string $id){
        $temperature=[];
        $humidity=[];
        $light=[];
        $time=[];
        $DataSensor = DataSensors::where('device_id', '=', $id)->orderBy('created_at', 'desc')->take(5)->get()->reverse();
        foreach($DataSensor as $data){
            array_push($temperature,$data->temperature);
            array_push($humidity,$data->humidity);
            array_push($light,$data->light_intensity);
            array_push($time,$data->created_at);
        }
        $log = Activity::where('properties->device_id', '=', $id)->orderBy('created_at', 'desc')->paginate(5);
        $heater = ConfigHeater::where('device_id', '=', $id)->first();
        return response()->json(
            [
                "message" => "Data berhasil diterima",
                "data" => [
                    'graph'=>['temperature'=>$temperature,'humidity'=>$humidity,'light'=>$light,'time'=>$time],
                    'log'=>$log,
                    'heater'=>$heater
                ]
            ],
            201
        );
    }

    public function getConfig(String $id){
        $heater = ConfigHeater::where('device_id', '=', $id)->first();
        $lamp = ConfigLamp::where('device_id','=',$id)->first();
        return response()->json([
            "message"=>"data berhasil diterima",
            "data"=>[
                "heaterConfig"=>$heater,
                "lampConfig"=>$lamp
            ]
        ],201);
    }
}
