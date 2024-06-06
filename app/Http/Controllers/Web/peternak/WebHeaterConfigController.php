<?php

namespace App\Http\Controllers\Web\peternak;

use App\Http\Controllers\Controller;
use App\Models\ConfigHeater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebHeaterConfigController extends Controller
{
    public function index(){
        $dataConfigHeater = ConfigHeater::with('Devices')->whereRelation('Devices','user_id','=',Auth::id())->get();
        return view('peternak.heater',[
            'data'=>$dataConfigHeater
        ]);
    }
}
