<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConfigHeater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigHeaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=ConfigHeater::with('Devices')->get();
        return response()->json(
            [
                "message" => "semua data konfigurasi Heater berhasil didapatkan",
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
            'mode'=> 'required',
            'status'=> 'required'

        ];
        $message = [
            'device_id.required' => 'device harus diisi',
            'device_id.exists' => 'device id yang di isi tidak ada',
            'mode.required'=> 'mode belum diisi',
            'status.required'=> 'Status harus diisi'

        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(["messages" => $messages], 500);
        }

        $user = ConfigHeater::create([
            "device_id" => $request->device_id,
            "mode"=> $request->mode,
            "status"=> $request->status,
            "max_temp"=> $request->max_temp,
            "min_temp"=> $request->min_temp,



    ]);
        activity('Config Heater Data')->performedOn($user)->log('created');

        return response()->json(
            [
                "message" => "Konfigurasi Heater berhasil dibuat",
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
        $data = ConfigHeater::with('Devices')->where('id', '=', $id)->get();
        return response()->json(
            [
                "message" => "data Konfigurasi Heater berhasil didapatkan",
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
        // $rule = [
        //     'device_id' => 'required|exists:devices,id',
        //     'mode'=> 'required',
        //     'status'=> 'required'

        // ];
        // $message = [
        //     'device_id.required' => 'device harus diisi',
        //     'device_id.exists' => 'device id yang di isi tidak ada',
        //     'mode.required'=> 'mode belum diisi',
        //     'status.required'=> 'Status harus diisi'

        // ];
        // return response()->json([
        //     'data'=>$request->all()
        // ]);
        // $validator = Validator::make($request->all(), $rule, $message);
        // if ($validator->fails()) {
        //     $messages = $validator->messages();
        //     return response()->json(["messages" => $messages], 500);
        // }
        $user = ConfigHeater::find($id)->update($request->all());
        activity('Config Heater Data')->performedOn($user)->log('update');
        return response()->json(
            [
                "message" => "Data Konfigurasi Heater berhasil diupdate",
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
        $data = ConfigHeater::destroy($id);
        return response()->json(
            [
                "message" => "Data Konfigurasi Heater berhasil dihapus"
            ],
            200
        );
    }
}
