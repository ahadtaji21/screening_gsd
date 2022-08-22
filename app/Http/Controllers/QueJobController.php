<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueJobController extends Controller
{
    //
    public function index (){

        $jobs = DB::table('jobs')->get();
        $failed_jobs = DB::table('failed_jobs')->orderBy('id','DESC')->get();

        return view('que_job.que_job_list')
            ->with(['jobs'=>$jobs, 'failed_jobs'=>$failed_jobs]);
    }
}
