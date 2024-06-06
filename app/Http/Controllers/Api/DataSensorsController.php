<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataSensors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use PhpMqtt\Client\Facades\MQTT;

class DataSensorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=DataSensors::with('Devices')->get();
        return response()->json(
            [
                "message" => "semua data Sensor berhasil didapatkan",
                "data" => $data
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'device_id' => 'required|exists:devices,id',

        ];
        $message = [
            'device_id.required' => 'device harus diisi',
            'device_id.exists' => 'device id yang di isi tidak ada',

        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(["messages" => $messages], 500);
        }

        $data = [
            "device_id" => $request->device_id,
            "temperature"=> $request->temperature,
            "humidity"=> $request->humidity,
            "light_intensity"=> $request->light_intensity,
        ];

        MQTT::publish('sensor/temperature', 'Hello World!', true, 'default');

        $user = DataSensors::create([
            "device_id" => $request->device_id,
            "temperature"=> $request->temperature,
            "humidity"=> $request->humidity,
            "light_intensity"=> $request->light_intensity,


    ]);



        return response()->json(
            [
                "message" => "Device berhasil dibuat",
                "data" => $user
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DataSensors::with('Devices')->where('id', '=', $id)->get();
        return response()->json(
            [
                "message" => "data Sensor berhasil didapatkan",
                "data" => $data
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rule = [
            'device_id' => 'required|exists:devices,id',

        ];
        $message = [
            'device_id.required' => 'device harus diisi',
            'device_id.exists' => 'device id yang di isi tidak ada',

        ];

        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(["messages" => $messages], 500);
        }
        $user = DataSensors::find($id)->update([
            "device_id" => $request->device_id,
            "temperature"=> $request->temperature,
            "humidity"=> $request->humidity,
            "light_intensity"=> $request->light_intensity,

        ]);
        return response()->json(
            [
                "message" => "Data Sensor berhasil diupdate",
                'data'=>$user
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DataSensors::destroy($id);
        return response()->json(
            [
                "message" => "Data Sensor berhasil dihapus"
            ],
            200
        );
    }
}
