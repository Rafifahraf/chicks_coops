<?php

namespace App\Http\Controllers\Web\admin;

use App\Http\Controllers\Controller;
use App\Models\ConfigHeater;
use App\Models\ConfigLamp;
use App\Models\Devices;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class WebDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_device_data = Devices::with('User')->get();
        return view('admin.device', [
            'get_device' => $get_device_data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataUser = User::all();
        return view('admin.FormDevice', [
            'dataUser' => $dataUser
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);
        DB::beginTransaction();
        $dataDevice = Devices::create([
            'user_id' => $request->user_id
        ]);
        ConfigHeater::create([
            'device_id' => $dataDevice->id,
            'mode' => 'manual',
            'status' => 0
        ]);
        ConfigLamp::create([
            'device_id'=>$dataDevice->id,
            'status'=>0,
            'time_on'=>0000,
            'time_off'=>0000
        ]);
        DB::commit();
        return redirect()->route('device.index')->with('message','Device has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Devices $devices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Devices $devices)
    {
        $dataUser = User::all();

        return view('admin.FormUpdateDevice', [
            'device_data' => $devices,

            'dataUser' => $dataUser
        ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Devices $devices)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $devices->update([
            'user_id' => $request->user_id
        ]);

        return redirect()->route('device.index')->with('message','Device has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devices $devices)
    {
        ConfigHeater::destroy(ConfigHeater::where('device_id','=',$devices->id)->first()->id);
        ConfigLamp::destroy(ConfigLamp::where('device_id','=',$devices->id)->first()->id);
        Devices::destroy($devices->id);
        return redirect()->route('device.index')->with('message','Device has been deleted');
    }
}
