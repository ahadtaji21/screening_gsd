<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //
    public function index()
    {
        $regions = Region::get();
        //dd($field_offices);
        return view('region.index',['regions'=>$regions]);
    }
}
