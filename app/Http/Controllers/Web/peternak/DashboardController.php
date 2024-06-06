<?php

namespace App\Http\Controllers\Web\peternak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        return view('peternak.dashboard', [

        ]);
    }
}
