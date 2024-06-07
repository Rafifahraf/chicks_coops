<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConfigLamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigLampController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=ConfigLamp::with('Devices')->get();
        return response()->json(
            [
                "message" => "semua data konfigurasi Lampu berhasil didapatkan",
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
            'status'=> 'required'

        ];
        $message = [
            'device_id.required' => 'device harus diisi',
            'device_id.exists' => 'device id yang di isi tidak ada',
            'status.required'=> 'Status harus diisi'

        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(["messages" => $messages], 500);
        }

        $user = ConfigLamp::create([
            "device_id" => $request->device_id,
            "status"=> $request->status,
            "time_on"=> $request->time_on,
            "time_off"=> $request->time_off,



    ]);
        activity('Config Lamp Data')->performedOn($user)->log('created');

        return response()->json(
            [
                "message" => "Konfigurasi Lampu berhasil dibuat",
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
        $data = ConfigLamp::with('Devices')->where('id', '=', $id)->get();
        return response()->json(
            [
                "message" => "data Konfigurasi Lampu berhasil didapatkan",
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
            'status'=> 'required'

        ];
        $message = [
            'device_id.required' => 'device harus diisi',
            'device_id.exists' => 'device id yang di isi tidak ada',
            'status.required'=> 'Status harus diisi'

        ];

        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(["messages" => $messages], 500);
        }
        $user = ConfigLamp::find($id)->update([
            "device_id" => $request->device_id,
            "status"=> $request->status,
            "time_on"=> $request->time_on,
            "time_off"=> $request->time_off,

        ]);
        activity('Config Lamp Data')->performedOn($user)->log('update');

        return response()->json(
            [
                "message" => "Data Konfigurasi Lampu berhasil diupdate",
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
        $data = ConfigLamp::destroy($id);
        return response()->json(
            [
                "message" => "Data Konfigurasi Lampu berhasil dihapus"
            ],
            200
        );
    }
}
