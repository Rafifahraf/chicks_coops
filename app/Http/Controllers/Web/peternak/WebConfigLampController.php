<?php

namespace App\Http\Controllers\Web\peternak;

use App\Http\Controllers\Controller;
use App\Models\ConfigLamp;
use App\Models\Devices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WebConfigLampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_config_lamp=ConfigLamp::with('Devices')->whereRelation('Devices','user_id','=',Auth::id())->get();
        // ddd($get_config_lamp);
        return view('peternak.lamp',[
            'datas_config_lamp'=>$get_config_lamp
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataDevice = Devices::where('user_id','=',Auth::id())->get();

        return view('peternak.CreateLamp', [
            'dataDevice' => $dataDevice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'status' => 'required'
        ]);


        $data=ConfigLamp::create([
            "device_id" => $request->device_id,
            "status" => $request->status,
            "time_on" => $request->time_on,
            "time_off" => $request->time_off,

        ]);
        activity('Web Config Lamp Data')->performedOn($data)->withProperty('device_id',$request->device_id)->log('Config Lamp has been created');
        return redirect()->route('lamp.index')->with('message','Config lamp has been created');

    }

    /**
     * Display the specified resource.
     */
    public function show(ConfigLamp $configLamp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConfigLamp $configLamp)
    {
        $dataDevice = Devices::where('user_id','=',Auth::id())->get();
        return view('peternak.UpdateLamp', [
            'dataDevice' => $dataDevice,
            'configLamp'=>$configLamp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConfigLamp $configLamp)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'status' => 'required'
        ]);


        $configLamp->update([
            "device_id" => $request->device_id,
            "status" => $request->status,
            "time_on" => $request->time_on,
            "time_off" => $request->time_off,

        ]);
        activity('Web Config Lamp Data')->performedOn($configLamp)->withProperty('device_id',$configLamp->device_id)->log('Config Lamp has been updated');
        return redirect()->route('lamp.index')->with('message','Config lamp has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConfigLamp $configLamp)
    {
        ConfigLamp::destroy($configLamp->id);
        activity('Web Config Lamp Data')->performedOn($configLamp)->withProperty('device_id',$configLamp->device_id)->log('Config Lamp has been deleted');
        return redirect()->route('lamp.index')->with('message','Config lamp has been deleted');
    }
}
