<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Devices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Devices::with('User')->get();
        return response()->json(
            [
                "message" => "semua data Device berhasil didapatkan",
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
            'user_id' => 'required|exists:users,id',

        ];
        $message = [
            'user_id.required' => 'user harus diisi',
            'user_id.exists' => 'user id yang di isi tidak ada',

        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(["messages" => $messages], 500);
        }

        $data = Devices::create([
            "user_id" => $request->user_id,

    ]);

        return response()->json(
            [
                "message" => "Device berhasil dibuat",
                "data" => $data
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Devices::with('User')->where('id', '=', $id)->get();
        return response()->json(
            [
                "message" => "data Device berhasil didapatkan",
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
            'user_id' => 'required|exists:users,id',

        ];
        $message = [
            'user_id.required' => 'user harus diisi',
            'user_id.exists' => 'user id yang di isi tidak ada',

        ];

        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(["messages" => $messages], 500);
        }
        $data = Devices::find($id)->update([
            "user_id" => $request->user_id,
        ]);
        return response()->json(
            [
                "message" => "Device berhasil diupdate",
                'data'=>$data
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Devices::destroy($id);
        return response()->json(
            [
                "message" => "Device berhasil dihapus"
            ],
            200
        );
    }
}
