<?php

namespace App\Http\Controllers;

use App\Models\Field_office;
use Illuminate\Http\Request;

class FieldOfficeController extends Controller
{
    public function index()
    {
        $field_offices = Field_office::with(['regionID'])
            ->get()
            ->sortBy('regionID.name')
//        ->sortByDesc('name')
        ;

//        dd($field_offices);

//        $field_offices = Field_office::orderBy('name','Asc')->with(['regionID' => function ($q) {
//            $q->orderBy('name')->get();
//        }])->get()->sortByDesc('regionID.name');

//        dd($field_offices);
        return view('field_offices.index',['field_offices'=>$field_offices]);
    }
}
