<?php

namespace App\Http\Controllers;

use App\Models\Employee_info;
use App\Models\Screening_detail;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Helper_functions;
use Nette\Utils\DateTime;

define('All', 0);
define('Asia', 1);
define('West_Africa', 2);
define('East_Africa', 3);
define('Menaee', 4);

class DashboardController extends Controller
{
    //


    public function index(Request $request)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        //dd($user_region_id,$user_field_office_id);


        // DB::enableQueryLog();
        //dd(DB::getQueryLog());


        //---------------------- 1st panel start ------------------------------------------------------
        //*********************************************************************************************

        /*
         * check first user region
         * if region is 0 then get all data
         * else region and field office wise (both)
         */

        //---create helper class instance
        $helper = new Helper_functions();

        //---making a dynamic query of 2nd panel "type_of_staff" with All region and particular region
        $employee_type = Screening_detail::groupBy('type_of_staff')
            ->select('type_of_staff', DB::raw('count(*) as total'));

        $employee_type = $employee_type
            ->where(
                function($query) use ($user_region_id, $user_field_office_id){
                    if ($user_region_id == All)
                    {
                        return $query;
                    }
                    else
                    {
                        return $query
                            ->where('region_id', '=', $user_region_id)
                            ->whereIn('field_office_id', $user_field_office_id);
                    }
                })->pluck('total', 'type_of_staff')->toArray();
            
        //---get all employee type from helper
        $employee_titles = $helper->employee_titles();

        //---checking all employee type from query result
        foreach($employee_titles as $key)
        {
            if(!array_key_exists($key, $employee_type))// if any type not found in array
            {
                $missing_titles[] = $key;
            }
        }

        if(isset($missing_titles) && is_array($missing_titles))
        {
            $missing_titles = array_flip($missing_titles);// flip keys into values
            $missing_titles = array_fill_keys(array_keys($missing_titles), 0);// array fill keys to 0

            $employee_type = array_merge($missing_titles, $employee_type);//merging both array
        }

        //-------------------------------------------------------------------------------------------

        /*$data = Employee_info::groupBy('gender')
            ->select('gender', DB::raw('count(*) as total'));

        $data = $data
            ->wherehas('screening',
            function($query) use ($user_region_id, $user_field_office_id){
                if ($user_region_id == All)
                {
                    return $query;
                }
                else
                {
                    return $query
                        ->where('region_id', $user_region_id)
                        ->whereIn('field_office_id', $user_field_office_id);

                }
            })->toSql();*/

        //dd($data);




        if ($user_region_id == All)// region is "ALL"
        {
            $total = Screening_detail::count();

            //dd($total);

            $total_emp = Employee_info::count();

            $pending = Screening_detail::where('screening_status', '1')->count();
            //$in_progress = Screening_detail::where('screening_status', '2')->count();

            $topBarDataYellow = Screening_detail::where('screening_status',1)
                ->whereDate('created_at', '=', Carbon::now()->subDays(4)->toDateString())
                ->count();
            $topBarDataRed = Screening_detail::where('screening_status',1)
                ->whereDate('created_at', '<=', Carbon::now()->subDays(5)->toDateString())
                ->count();

            $completed_active = Screening_detail::where('screening_status', '2')
                ->where('record_status','1')
                ->count();

            $completed_archive = Screening_detail::where('screening_status', '2')
                ->where('record_status','2')
                ->count();


            $male = Employee_info::where('gender', 'Male')
                ->count();

            $female = Employee_info::where('gender', 'Female')
                ->count();

            $other = Employee_info::where('gender', 'Prefer not to say')
                ->count();

            //dd($other);

            $current = Screening_detail::where('employee_status', '1')
                ->count();

            $leaver = Screening_detail::where('employee_status', '2')->count();

            //------------------------ 2nd panel ------------------------------------------------

            $male_east_africa = $helper->gender_region_wise('Male', 3);
            $female_east_africa  = $helper->gender_region_wise('Female', 3);            
            $other_east_africa   = $helper->gender_region_wise('Prefer not to say', 3);

            $male_west_africa    = $helper->gender_region_wise('Male', 2);
            $female_west_africa  = $helper->gender_region_wise('Female', 2);
            $other_west_africa   = $helper->gender_region_wise('Prefer not to say', 2);
            
            $male_asia           = $helper->gender_region_wise('Male', 1);
            $female_asia         = $helper->gender_region_wise('Female', 1);
            $other_asia          = $helper->gender_region_wise('Prefer not to say', 1);
            
            $male_menaee         = $helper->gender_region_wise('Male', 4);
            $female_menaee       = $helper->gender_region_wise('Female', 4);
            $other_menaee        =   $helper->gender_region_wise('Prefer not to say', 4);

             /*$male_east_africa = Screening_detail::whereHas('Employee_info',function ($query)
                 {
                     $query->where('gender','Male');
                 }
                 )->where('region_id','3')
                 ->count();*/

            $count = Screening_detail::select(DB::raw('

                COUNT( CASE WHEN employee_status = 1 AND region_id = 1 THEN employee_status END ) as "current_asia",
                COUNT( CASE WHEN employee_status = 2 AND region_id = 1 THEN employee_status END ) as "leaver_asia",
                
                COUNT( CASE WHEN employee_status = 1 AND region_id = 2 THEN employee_status END ) as "current_west_africa",
                COUNT( CASE WHEN employee_status = 2 AND region_id = 2 THEN employee_status END ) as "leaver_west_africa",
                
                COUNT( CASE WHEN employee_status = 1 AND region_id = 3 THEN employee_status END ) as "current_east_africa",
                COUNT( CASE WHEN employee_status = 2 AND region_id = 3 THEN employee_status END ) as "leaver_east_africa",
                
                COUNT( CASE WHEN employee_status = 1 AND region_id = 4 THEN employee_status END ) as "current_menaee",
                COUNT( CASE WHEN employee_status = 2 AND region_id = 4 THEN employee_status END ) as "leaver_menaee"
        
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                        ->get();

            //dd($count);

            $count_status = Screening_detail::select(DB::raw('

                COUNT( CASE WHEN screening_status = 1 AND region_id = 1 THEN employee_status END ) as "pending_asia",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 1 AND region_id = 1 THEN employee_status END ) as "completed_active_asia",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 2 AND region_id = 1 THEN employee_status END ) as "completed_archive_asia",
                
                COUNT( CASE WHEN screening_status = 1 AND region_id = 2 THEN employee_status END ) as "pending_west_africa",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 1 AND region_id = 2 THEN employee_status END ) as "completed_active_west_africa",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 2 AND region_id = 2 THEN employee_status END ) as "completed_archive_west_africa",
                
                COUNT( CASE WHEN screening_status = 1 AND region_id = 3 THEN screening_status END ) as "pending_east_africa",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 1 AND region_id = 3 THEN screening_status END ) as "completed_active_east_africa",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 2 AND region_id = 3 THEN screening_status END ) as "completed_archive_east_africa",
                
                COUNT( CASE WHEN screening_status = 1 AND region_id = 4 THEN employee_status END ) as "pending_menaee",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 1 AND region_id = 4 THEN employee_status END ) as "completed_active_menaee",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 2 AND region_id = 4 THEN employee_status END ) as "completed_archive_menaee"
        
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                        ->get();

        }
        else
        {
            $total = Screening_detail::where('region_id', $user_region_id)
                ->whereIn('field_office_id',$user_field_office_id)
                ->count();

            //dd($total);

            /*$total_emp1 = Screening_detail::where('region_id', $user_region_id)
                ->whereIn('field_office_id',$user_field_office_id)
                ->count();*/

            $total_emp = Employee_info::whereHas('screening', function ($query) use($user_region_id,$user_field_office_id)
            {
                $query->where('region_id', $user_region_id);
                $query->whereIn('field_office_id',$user_field_office_id);
                $query->where('employee_status', 1);
            }
            )->count();

            //$total_emp2 = Employee_info::where('created_by', Auth::user()->id)->count();

            //dd($total_emp1, $total_emp2);

            //---checking employee record and employee record with screening
            /*if ($total_emp2 > $total_emp1)
            {
                $total_emp = $total_emp2;
            }
            else
            {
                $total_emp = $total_emp1;
            }*/
            //dd($total_emp2,$total_emp1);


            $pending = Screening_detail::where('region_id', '=', $user_region_id)
                ->whereIn('field_office_id', $user_field_office_id)
                ->where('screening_status', '1')
                ->where('record_status','1')
                ->count();
            //$in_progress = Screening_detail::where('screening_status', '2')->count();

            $topBarDataYellow = Screening_detail::where('region_id',$user_region_id)
                ->whereIn('field_office_id', $user_field_office_id)
                ->where('screening_status',1)
                ->where('record_status','1')
                ->whereDate('created_at', '=', Carbon::now()->subDays(4)->toDateString())
                ->count();

            $topBarDataRed = Screening_detail::where('region_id',$user_region_id)
                ->whereIn('field_office_id', $user_field_office_id)
                ->where('screening_status',1)
                ->where('record_status','1')
                ->whereDate('created_at', '=', Carbon::now()->subDays(5)->toDateString())
                ->count();

            $completed_active = Screening_detail::where('region_id', '=', $user_region_id)
                ->whereIn('field_office_id', $user_field_office_id)
                ->where('screening_status', '2')
                ->where('record_status','1')
                ->count();

            $completed_archive = Screening_detail::where('region_id', '=', $user_region_id)
                ->whereIn('field_office_id', $user_field_office_id)
                ->where('screening_status', '2')
                ->where('record_status','2')
                ->count();


            $male = Screening_detail::whereHas('Employee_info',function ($query)
                {
                    $query->where('gender', 'Male');
                }
                )
                ->where('region_id', $user_region_id)
                ->whereIn('field_office_id',$user_field_office_id)
                ->count();

            $female = Screening_detail::whereHas('Employee_info',function ($query)
                {
                    $query->where('gender', 'Female');
                }
                )
                ->where('region_id', $user_region_id)
                ->whereIn('field_office_id',$user_field_office_id)
                ->count();

            $other = Screening_detail::whereHas('Employee_info',function ($query)
                {
                    $query->where('gender', 'Prefer not to say');
                }
                )
                ->where('region_id', $user_region_id)
                ->whereIn('field_office_id',$user_field_office_id)
                ->count();

            //dd($other);

            $current = Screening_detail::where('region_id', '=', $user_region_id)
                ->whereIn('field_office_id', $user_field_office_id)
                ->where('employee_status', '1')
                ->count();

            $leaver = Screening_detail::where('region_id', '=', $user_region_id)
                ->whereIn('field_office_id', $user_field_office_id)
                ->where('employee_status', '2')
                ->count();

            //--------------------- 1st panel end ----------------------------------------------------------
            /*
             * *********************************************************************************************
             * now nested if for region wise data
             * compare region data with user region and field office (both)
             * *********************************************************************************************
             */

            if ($user_region_id == Asia)//-- user has Asia Region
            {
                $male_asia = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Male');
                    }
                    )
                    ->where('region_id','1')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();
                $female_asia = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Female');
                    }
                    )
                    ->where('region_id','1')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();
                $other_asia = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Prefer not to say');
                    }
                    )
                    ->where('region_id','1')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();

                $male_west_africa = 0;
                $female_west_africa = 0;
                $other_west_africa = 0;
                $male_east_africa = 0;
                $female_east_africa = 0;
                $other_east_africa = 0;
                $male_menaee = 0;
                $female_menaee = 0;
                $other_menaee = 0;

                $count = Screening_detail::select(DB::raw('

                        COUNT( CASE WHEN employee_status = 1 
                                        AND region_id = 1 
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                              END ) as "current_asia",
                        COUNT( CASE WHEN employee_status = 2 AND region_id = 1 
                                        AND field_office_id IN ('.$field_office_id.')
                                    THEN employee_status
                               END ) as "leaver_asia",
                               0 as current_west_africa,
                               0 as leaver_west_africa,
                               0 as current_east_africa,
                               0 as leaver_east_africa,
                               0 as current_menaee,
                               0 as leaver_menaee
        
                '))
                    //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                    ->get();


                $count_status = Screening_detail::select(DB::raw('

                        COUNT( CASE WHEN screening_status = 1 AND region_id = 1 
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                                END ) as "pending_asia",
                        COUNT( CASE WHEN screening_status = 2 AND record_status = 1 
                                        AND region_id = 1
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                               END ) as "completed_active_asia",
                        COUNT( CASE WHEN screening_status = 2 AND record_status = 2 
                                        AND region_id = 1
                                        AND field_office_id IN ('.$field_office_id.') 
                                     THEN employee_status 
                                END ) as "completed_archive_asia",
                        
                        0 as pending_west_africa,
                        0 as completed_active_west_africa,
                        0 as completed_archive_west_africa,
                        0 as pending_east_africa,
                        0 as completed_active_east_africa,
                        0 as completed_archive_east_africa,
                        0 as pending_menaee,
                        0 as completed_active_menaee,
                        0 as completed_archive_menaee
                        
                
                '))
                    //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                    ->get();
                
            }

            elseif ($user_region_id == West_Africa)
            {
                $male_west_africa = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Male');
                    }
                    )
                    ->where('region_id','2')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();
                $female_west_africa = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Female');
                    }
                    )
                    ->where('region_id','2')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();
                $other_west_africa = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Prefer not to say');
                    }
                    )
                    ->where('region_id','2')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();

                $male_asia = 0;
                $female_asia = 0;
                $other_asia = 0;
                $male_east_africa = 0;
                $female_east_africa = 0;
                $other_east_africa = 0;
                $male_menaee = 0;
                $female_menaee = 0;
                $other_menaee = 0;

                $count = Screening_detail::select(DB::raw('

                        COUNT( CASE WHEN employee_status = 1 
                                        AND region_id = 2 
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                              END ) as "current_west_africa",
                        COUNT( CASE WHEN employee_status = 2 AND region_id = 2 
                                        AND field_office_id IN ('.$field_office_id.')
                                    THEN employee_status
                               END ) as "leaver_west_africa",
                               0 as current_asia,
                               0 as leaver_asia,
                               0 as current_east_africa,
                               0 as leaver_east_africa,
                               0 as current_menaee,
                               0 as leaver_menaee
        
                '))
                    //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                    ->get();

                $count_status = Screening_detail::select(DB::raw('

                        COUNT( CASE WHEN screening_status = 1 AND region_id = 2 
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                                END ) as "pending_west_africa",
                        COUNT( CASE WHEN screening_status = 2 AND record_status = 1 
                                        AND region_id = 2
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                               END ) as "completed_active_west_africa",
                        COUNT( CASE WHEN screening_status = 2 AND record_status = 2 
                                        AND region_id = 2
                                        AND field_office_id IN ('.$field_office_id.') 
                                     THEN employee_status 
                                END ) as "completed_archive_west_africa",
                        0 as pending_asia,
                        0 as completed_active_asia,
                        0 as completed_archive_asia,
                        0 as pending_east_africa,
                        0 as completed_active_east_africa,
                        0 as completed_archive_east_africa,
                        0 as pending_menaee,
                        0 as completed_active_menaee,
                        0 as completed_archive_menaee
                        
                
                '))
                    //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                    ->get();
                
            }

            elseif ($user_region_id == East_Africa)
            {
                $male_east_africa = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Male');
                    }
                    )
                    ->where('region_id','3')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();
                $female_east_africa = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Female');
                    }
                    )
                    ->where('region_id','3')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();
                $other_east_africa = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Prefer not to say');
                    }
                    )
                    ->where('region_id','3')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();

                $male_asia = 0;
                $female_asia = 0;
                $other_asia = 0;
                $male_west_africa = 0;
                $female_west_africa = 0;
                $other_west_africa = 0;
                $male_menaee = 0;
                $female_menaee = 0;
                $other_menaee = 0;

                $count = Screening_detail::select(DB::raw('

                        COUNT( CASE WHEN employee_status = 1 
                                        AND region_id = 3 
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                              END ) as "current_east_africa",
                        COUNT( CASE WHEN employee_status = 2 AND region_id = 3 
                                        AND field_office_id IN ('.$field_office_id.')
                                    THEN employee_status
                               END ) as "leaver_east_africa",
                               0 as current_asia,
                               0 as leaver_asia,
                               0 as current_west_africa,
                               0 as leaver_west_africa,
                               0 as current_menaee,
                               0 as leaver_menaee
        
                '))
                    //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                    ->get();

                $count_status = Screening_detail::select(DB::raw('

                        COUNT( CASE WHEN screening_status = 1 AND region_id = 3 
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                                END ) as "pending_east_africa",
                        COUNT( CASE WHEN screening_status = 2 AND record_status = 1 
                                        AND region_id = 3
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                               END ) as "completed_active_east_africa",
                        COUNT( CASE WHEN screening_status = 2 AND record_status = 2 
                                        AND region_id = 3
                                        AND field_office_id IN ('.$field_office_id.') 
                                     THEN employee_status 
                                END ) as "completed_archive_east_africa",
                        0 as pending_asia,
                        0 as completed_active_asia,
                        0 as completed_archive_asia,
                        0 as pending_west_africa,
                        0 as completed_active_west_africa,
                        0 as completed_archive_west_africa,
                        0 as pending_menaee,
                        0 as completed_active_menaee,
                        0 as completed_archive_menaee
                        
                
                '))
                    //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                    ->get();
            }

            elseif ($user_region_id == Menaee)
            {
                $male_menaee = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Male');
                    }
                    )
                    ->where('region_id','4')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();
                $female_menaee = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Female');
                    }
                    )
                    ->where('region_id','4')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();
                $other_menaee = Screening_detail::whereHas('Employee_info', function ($query)
                    {
                        $query->where('gender', 'Male');
                    }
                    )
                    ->where('region_id','4')
                    ->whereIn('field_office_id',$user_field_office_id)
                    ->count();

                $male_asia = 0;
                $female_asia = 0;
                $other_asia = 0;
                $male_west_africa = 0;
                $female_west_africa = 0;
                $other_west_africa = 0;
                $male_east_africa = 0;
                $female_east_africa = 0;
                $other_east_africa = 0;


                $count = Screening_detail::select(DB::raw('

                        COUNT( CASE WHEN employee_status = 1 
                                        AND region_id = 4 
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                              END ) as "current_menaee",
                        COUNT( CASE WHEN employee_status = 2 AND region_id = 4 
                                        AND field_office_id IN ('.$field_office_id.')
                                    THEN employee_status
                               END ) as "leaver_menaee",
                               0 as current_asia,
                               0 as leaver_asia,
                               0 as current_west_africa,
                               0 as leaver_west_africa,
                               0 as current_east_africa,
                               0 as leaver_east_africa
        
                '))
                    //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                    ->get();

                $count_status = Screening_detail::select(DB::raw('

                        COUNT( CASE WHEN screening_status = 1 AND region_id = 4 
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                                END ) as "pending_menaee",
                        COUNT( CASE WHEN screening_status = 2 AND record_status = 1 
                                        AND region_id = 4
                                        AND field_office_id IN ('.$field_office_id.') 
                                    THEN employee_status 
                               END ) as "completed_active_menaee",
                        COUNT( CASE WHEN screening_status = 2 AND record_status = 2 
                                        AND region_id = 4
                                        AND field_office_id IN ('.$field_office_id.') 
                                     THEN employee_status 
                                END ) as "completed_archive_menaee",
                        0 as pending_asia,
                        0 as completed_active_asia,
                        0 as completed_archive_asia,
                        0 as pending_west_africa,
                        0 as completed_active_west_africa,
                        0 as completed_archive_west_africa,
                        0 as pending_east_africa,
                        0 as completed_active_east_africa,
                        0 as completed_archive_east_africa
                        
                '))
                    //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                    ->get();

            }



            /*$count = Screening_detail::select(DB::raw('

                COUNT( CASE WHEN employee_status = 1 
                                AND emp.region_id = '.$user_region_id.' 
                                AND emp.field_office_id IN ('.$field_office_id.') 
                            THEN employee_status 
                            ELSE 0
                      END ) as "current_asia",
                COUNT( CASE WHEN employee_status = 2 AND emp.region_id = '.$user_region_id.' 
                                AND emp.field_office_id IN ('.$field_office_id.')
                            THEN employee_status
                            ELSE 0
                       END ) as "leaver_asia",
                
                COUNT( CASE WHEN employee_status = 1 
                                AND emp.region_id = '.$user_region_id.' 
                                AND emp.field_office_id IN ('.$field_office_id.')
                            THEN employee_status
                            ELSE 0
                       END ) as "current_west_africa",
                       
                COUNT( CASE WHEN employee_status = 2 
                                AND emp.region_id = '.$user_region_id.' 
                                AND emp.field_office_id IN ('.$field_office_id.') 
                            THEN employee_status
                            ELSE 0
                       END ) as "leaver_west_africa",
                
                COUNT( CASE WHEN employee_status = 1 
                                AND emp.region_id = '.$user_region_id.' 
                                AND emp.field_office_id IN ('.$field_office_id.') 
                             THEN employee_status
                             ELSE 0
                        END ) as "current_east_africa",
                        
                COUNT( CASE WHEN employee_status = 2 
                                AND emp.region_id = '.$user_region_id.' 
                                AND emp.field_office_id IN ('.$field_office_id.') 
                            THEN employee_status
                            ELSE 0
                       END ) as "leaver_east_africa",
                
                COUNT( CASE WHEN employee_status = 1 
                                AND emp.region_id = '.$user_region_id.' 
                                AND emp.field_office_id IN ('.$field_office_id.')
                            THEN employee_status
                            ELSE 0
                        END ) as "current_menaee",
                        
                COUNT( CASE WHEN employee_status = 2 
                                AND emp.region_id = '.$user_region_id.' 
                                AND emp.field_office_id IN ('.$field_office_id.') 
                             THEN employee_status
                             ELSE 0
                       END ) as "leaver_menaee"
        
                '))->join('employee_infos AS emp','emp.id','=','employee_info_id')
                        ->toSql();

            dd($count);*/

            /*$count_status = Screening_detail::select(DB::raw('

                COUNT( CASE WHEN screening_status = 1 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "pending_asia",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 1 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "completed_active_asia",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 2 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "completed_archive_asia",
                
                COUNT( CASE WHEN screening_status = 1 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "pending_west_africa",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 1 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "completed_active_west_africa",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 2 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "completed_archive_west_africa",
                
                COUNT( CASE WHEN screening_status = 1 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN screening_status END ) as "pending_east_africa",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 1 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN screening_status END ) as "completed_active_east_africa",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 2 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN screening_status END ) as "completed_archive_east_africa",
                
                COUNT( CASE WHEN screening_status = 1 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "pending_menaee",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 1 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "completed_active_menaee",
                COUNT( CASE WHEN screening_status = 2 AND record_status = 2 AND emp.region_id = '.$user_region_id.' AND emp.field_office_id IN ('.$field_office_id.') THEN employee_status END ) as "completed_archive_menaee"
        
                '))->join('employee_infos AS emp','emp.id','=','employee_info_id')
                        ->get();*/



            //dd($topBarDataYellow,$topBarDataRed );


        }//---end main if region


        return view('dashboard.dashboard')->with([
            'total'=> $total,
            'total_emp'=> $total_emp,
            'pending' => $pending,
            //'in_progress' => $in_progress,
            'completed_active' => $completed_active,
            'completed_archive' => $completed_archive,
            
            'current' => $current,
            'leaver' => $leaver,

            'male' => $male,
            'female' => $female,
            'other' => $other,
            //'prefer_not' => $prefer_not,

            'employee_type' => $employee_type,

            'male_east_africa' => $male_east_africa,
            'female_east_africa' => $female_east_africa,
            'other_east_africa' => $other_east_africa,
            'male_west_africa' => $male_west_africa,
            'female_west_africa' => $female_west_africa,
            'other_west_africa' => $other_west_africa,
            'male_asia' => $male_asia,
            'female_asia' => $female_asia,
            'other_asia' => $other_asia,
            'male_menaee' => $male_menaee,
            'female_menaee' => $female_menaee,
            'other_menaee' => $other_menaee,

            'count_emp_region' => $count,

            'count_status_region' => $count_status,

            'yellow_count' => $topBarDataYellow,
            'red_count' => $topBarDataRed,
            
        ]);

    }

    //-------------------------- Charts --------------------------
    function getAllMonths()
    {
        $month_array = array();
        $post_dates = Screening_detail::orderBy('created_at','ASC')->pluck('created_at');
        $post_dates = json_decode($post_dates);

        if (!empty($post_dates))
        {
            foreach ($post_dates as $unformed_date)
            {
                $date = new DateTime($unformed_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] = $month_name;
            }
        }
        return $month_array;
    }

    function getMonthlyPendingStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count = Screening_detail::whereMonth('created_at', $month)
                ->where('screening_status',1)
                ->get()
                ->count();
            return $monthly_status_count;
        }
        else
        {

            $monthly_status_count = Screening_detail::where('region_id', '=', $user_region_id)
                ->whereIn('field_office_id', $user_field_office_id)
                ->whereMonth('created_at', $month)
                ->where('screening_status',1)
                ->get()
                ->count();
            return $monthly_status_count;
        }

    }

    function getMonthlyCompletedStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count = Screening_detail::whereMonth('created_at', $month)
                ->where('screening_status',2)
                ->get()
                ->count();
            return $monthly_status_count;
        }
        else
        {
                $monthly_status_count = Screening_detail::where('region_id', '=', $user_region_id)
                    ->whereIn('field_office_id', $user_field_office_id)
                    ->whereMonth('created_at', $month)
                    ->where('screening_status',2)
                    ->get()
                    ->count();
            return $monthly_status_count;
        }

    }

    function getMonthlyScreeningStatusData()
    {
        $monthly_pending_count_array = array();
        $monthly_completed_count_array = array();
        $month_name_array = array();
        $month_array = $this->getAllMonths();
        if (!empty($month_array))
        {
            foreach ($month_array as $month_no => $month_name)
            {
                $monthly_pending_count = $this->getMonthlyPendingStatusCount($month_no);
                $monthly_completed_count = $this->getMonthlyCompletedStatusCount($month_no);
                array_push($monthly_pending_count_array,$monthly_pending_count);
                array_push($monthly_completed_count_array,$monthly_completed_count);
                array_push($month_name_array,$month_name);
            }
        }

        if ($monthly_pending_count_array > $monthly_completed_count_array)
        {
            $max_no = max($monthly_pending_count_array);
        }
        else
        {
            $max_no = max($monthly_completed_count_array);
        }
        
        $max = round(($max_no + 10/2)/10) * 10;
        $monthly_status_count_array = array(
            'months' => $month_name_array,
            'status_pending_count' => $monthly_pending_count_array,
            'status_completed_count' => $monthly_completed_count_array,
            'max' => $max,
        );
        return $monthly_status_count_array;
    }


    function getMonthlyCurrentStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count = Screening_detail::whereMonth('created_at', $month)
                ->where('employee_status',1)
                ->get()
                ->count();
            return $monthly_status_count;
        }
        else
        {
                $monthly_status_count = Screening_detail::where('region_id', '=', $user_region_id)
                    ->whereIn('field_office_id', $user_field_office_id)
                    ->whereMonth('created_at', $month)
                    ->where('employee_status',1)
                    ->get()
                    ->count();
            return $monthly_status_count;
        }

    }

    function getMonthlyLeaverStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count = Screening_detail::whereMonth('created_at', $month)
                ->where('employee_status',2)
                ->get()
                ->count();
            return $monthly_status_count;
        }
        else
        {
                $monthly_status_count = Screening_detail::where('region_id', '=', $user_region_id)
                    ->whereIn('field_office_id', $user_field_office_id)
                    ->whereMonth('created_at', $month)
                    ->where('employee_status',2)
                    ->get()
                    ->count();
            return $monthly_status_count;
        }

    }

    function getMonthlyEmployeeStatusData()
    {
        $monthly_current_count_array = array();
        $monthly_leaver_count_array = array();
        $month_name_array = array();
        $month_array = $this->getAllMonths();
        if (!empty($month_array))
        {
            foreach ($month_array as $month_no => $month_name)
            {
                $monthly_pending_count = $this->getMonthlyCurrentStatusCount($month_no);
                $monthly_completed_count = $this->getMonthlyLeaverStatusCount($month_no);
                array_push($monthly_current_count_array,$monthly_pending_count);
                array_push($monthly_leaver_count_array,$monthly_completed_count);
                array_push($month_name_array,$month_name);
            }
        }

        if ($monthly_current_count_array > $monthly_leaver_count_array)
        {
            $max_no = max($monthly_current_count_array);
        }
        else
        {
            $max_no = max($monthly_leaver_count_array);
        }

        $max = round(($max_no + 10/2)/10) * 10;
        $monthly_employee_status_count_array = array(
            'months' => $month_name_array,
            'status_current_count' => $monthly_current_count_array,
            'status_leaver_count' => $monthly_leaver_count_array,
            'max' => $max,
        );

        return $monthly_employee_status_count_array;
    }




    function getMonthlyEastAfricaPendingStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count_east_africa = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 1 AND region_id = 3 THEN screening_status END ) as "pending_east_africa"
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();

            //dd($monthly_status_count_east_africa[0]->pending_east_africa);
            return $monthly_status_count_east_africa[0]->pending_east_africa;
        }
        else
        {
            $monthly_status_count_east_africa = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 1 AND region_id = 3 
                            AND field_office_id IN ('.$field_office_id.')
                        THEN screening_status
                   END ) as "pending_east_africa"
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();

            //dd($monthly_status_count_east_africa[0]->pending_east_africa);
            return $monthly_status_count_east_africa[0]->pending_east_africa;
        }
    }

    function getMonthlyEastAfricaCompletedStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 2 AND region_id = 3 THEN screening_status END ) as "completed_active_east_africa"        
            '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();
            return $monthly_status_count[0]->completed_active_east_africa;
        }
        else
        {
            $monthly_status_count = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 2 
                            AND region_id = 3 
                            AND field_office_id IN ('.$field_office_id.')
                        THEN screening_status
                   END ) as "completed_active_east_africa"        
            '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();
            return $monthly_status_count[0]->completed_active_east_africa;
        }
    }

    function getMonthlyEastAfricaStatusData()
    {
        $monthly_pending_count_array = array();
        $monthly_completed_count_array = array();
        $month_name_array = array();
        $month_array = $this->getAllMonths();
        if (!empty($month_array))
        {
            foreach ($month_array as $month_no => $month_name)
            {
                $monthly_pending_count = $this->getMonthlyEastAfricaPendingStatusCount($month_no);
                $monthly_completed_count = $this->getMonthlyEastAfricaCompletedStatusCount($month_no);
                //dd($monthly_pending_count);
                array_push($monthly_pending_count_array,$monthly_pending_count);
                array_push($monthly_completed_count_array,$monthly_completed_count);
                array_push($month_name_array,$month_name);
            }
        }
        //dd($month_name_array);

        if ($monthly_pending_count_array > $monthly_completed_count_array)
        {
            $max_no = max($monthly_pending_count_array);
        }
        else
        {
            $max_no = max($monthly_completed_count_array);
        }

        $max = round(($max_no + 10/2)/10) * 10;
        $monthly_east_africa_status_count_array = array(
            'months' => $month_name_array,
            'east_africa_status_pending_count' => $monthly_pending_count_array,
            'east_africa_status_completed_count' => $monthly_completed_count_array,
            'max' => $max,
        );
        //dd($monthly_east_africa_status_count_array);
        return $monthly_east_africa_status_count_array;
    }


    function getMonthlyWestAfricaPendingStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count_east_africa = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 1 AND region_id = 2 THEN screening_status END ) as "pending_west_africa"
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();

            //dd($monthly_status_count_east_africa[0]->pending_east_africa);
            return $monthly_status_count_east_africa[0]->pending_west_africa;
        }
        else
        {
            $monthly_status_count_east_africa = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 1 AND region_id = 2 
                            AND field_office_id IN ('.$field_office_id.')
                        THEN screening_status
                    END ) as "pending_west_africa"
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();

            //dd($monthly_status_count_east_africa[0]->pending_east_africa);
            return $monthly_status_count_east_africa[0]->pending_west_africa;
        }

    }

    function getMonthlyWestAfricaCompletedStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 2 AND region_id = 2 THEN screening_status END ) as "completed_active_west_africa"        
            '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();
            return $monthly_status_count[0]->completed_active_west_africa;
        }
        else
        {
            $monthly_status_count = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 2
                            AND region_id = 2
                            AND field_office_id IN ('.$field_office_id.')
                        THEN screening_status
                    END ) as "completed_active_west_africa"        
            '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();
            return $monthly_status_count[0]->completed_active_west_africa;
        }
    }

    function getMonthlyWestAfricaStatusData()
    {
        $monthly_pending_count_array = array();
        $monthly_completed_count_array = array();
        $month_name_array = array();
        $month_array = $this->getAllMonths();
        if (!empty($month_array))
        {
            foreach ($month_array as $month_no => $month_name)
            {
                $monthly_pending_count = $this->getMonthlyWestAfricaPendingStatusCount($month_no);
                $monthly_completed_count = $this->getMonthlyWestAfricaCompletedStatusCount($month_no);
                //dd($monthly_pending_count);
                array_push($monthly_pending_count_array,$monthly_pending_count);
                array_push($monthly_completed_count_array,$monthly_completed_count);
                array_push($month_name_array,$month_name);
            }
        }
        //dd($month_name_array);

        if ($monthly_pending_count_array > $monthly_completed_count_array)
        {
            $max_no = max($monthly_pending_count_array);
        }
        else
        {
            $max_no = max($monthly_completed_count_array);
        }

        $max = round(($max_no + 10/2)/10) * 10;
        $monthly_east_africa_status_count_array = array(
            'months' => $month_name_array,
            'west_africa_status_pending_count' => $monthly_pending_count_array,
            'west_africa_status_completed_count' => $monthly_completed_count_array,
            'max' => $max,
        );
        //dd($monthly_east_africa_status_count_array);
        return $monthly_east_africa_status_count_array;
    }


    function getMonthlyAsiaPendingStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count_east_africa = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 1 AND region_id = 1 THEN screening_status END ) as "pending_asia"
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();

            //dd($monthly_status_count_east_africa[0]->pending_east_africa);
            return $monthly_status_count_east_africa[0]->pending_asia;
        }
        else
        {
            $monthly_status_count_east_africa = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 1 AND region_id = 1 
                            AND field_office_id IN ('.$field_office_id.')
                        THEN screening_status
                   END ) as "pending_asia"
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();

            //dd($monthly_status_count_east_africa[0]->pending_east_africa);
            return $monthly_status_count_east_africa[0]->pending_asia;
        }

    }

    function getMonthlyAsiaCompletedStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 2 AND region_id = 1 THEN screening_status END ) as "completed_active_asia"        
            '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();
            return $monthly_status_count[0]->completed_active_asia;
        }
        else
        {
            $monthly_status_count = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 2 
                            AND region_id = 1 
                            AND field_office_id IN ('.$field_office_id.')
                        THEN screening_status 
                   END ) as "completed_active_asia"        
            '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();
            return $monthly_status_count[0]->completed_active_asia;
        }
    }

    function getMonthlyAsiaStatusData()
    {
        $monthly_pending_count_array = array();
        $monthly_completed_count_array = array();
        $month_name_array = array();
        $month_array = $this->getAllMonths();
        if (!empty($month_array))
        {
            foreach ($month_array as $month_no => $month_name)
            {
                $monthly_pending_count = $this->getMonthlyAsiaPendingStatusCount($month_no);
                $monthly_completed_count = $this->getMonthlyAsiaCompletedStatusCount($month_no);
                //dd($monthly_pending_count);
                array_push($monthly_pending_count_array,$monthly_pending_count);
                array_push($monthly_completed_count_array,$monthly_completed_count);
                array_push($month_name_array,$month_name);
            }
        }
        //dd($month_name_array);

        if ($monthly_pending_count_array > $monthly_completed_count_array)
        {
            $max_no = max($monthly_pending_count_array);
        }
        else
        {
            $max_no = max($monthly_completed_count_array);
        }

        $max = round(($max_no + 10/2)/10) * 10;
        $monthly_east_africa_status_count_array = array(
            'months' => $month_name_array,
            'asia_status_pending_count' => $monthly_pending_count_array,
            'asia_status_completed_count' => $monthly_completed_count_array,
            'max' => $max,
        );
        //dd($monthly_east_africa_status_count_array);
        return $monthly_east_africa_status_count_array;
    }


    function getMonthlyMenaeePendingStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count_east_africa = Screening_detail::select(DB::raw('
             COUNT( CASE WHEN screening_status = 1 AND region_id = 4 THEN screening_status END ) as "pending_menaee"
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();

            //dd($monthly_status_count_east_africa[0]->pending_east_africa);
            return $monthly_status_count_east_africa[0]->pending_menaee;
        }
        else
        {
            $monthly_status_count_east_africa = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 1 AND region_id = 4 
                            AND field_office_id IN ('.$field_office_id.')
                        THEN screening_status 
                   END ) as "pending_menaee"
                '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();

            //dd($monthly_status_count_east_africa[0]->pending_east_africa);
            return $monthly_status_count_east_africa[0]->pending_menaee;
        }

    }

    function getMonthlyMenaeeCompletedStatusCount($month)
    {
        $user_region_id = Auth::user()->region_id;
        $field_office_id = Auth::user()->field_office_id;
        $user_field_office_id = explode(",",$field_office_id);

        if ($user_region_id == All)
        {
            $monthly_status_count = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 2 AND region_id = 4 THEN screening_status END ) as "completed_active_menaee"        
            '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();
            return $monthly_status_count[0]->completed_active_menaee;
        }
        else
        {
            $monthly_status_count = Screening_detail::select(DB::raw('
            COUNT( CASE WHEN screening_status = 2 
                            AND field_office_id IN ('.$field_office_id.')
                            AND region_id = 4 
                         THEN screening_status 
                    END ) as "completed_active_menaee"        
            '))
                //->join('employee_infos AS emp','emp.id','=','employee_info_id')
                ->whereMonth('screening_details.created_at',$month)
                ->get();
            return $monthly_status_count[0]->completed_active_menaee;
        }
    }

    function getMonthlyMenaeeStatusData()
    {
        $monthly_pending_count_array = array();
        $monthly_completed_count_array = array();
        $month_name_array = array();
        $month_array = $this->getAllMonths();
        if (!empty($month_array))
        {
            foreach ($month_array as $month_no => $month_name)
            {
                $monthly_pending_count = $this->getMonthlyMenaeePendingStatusCount($month_no);
                $monthly_completed_count = $this->getMonthlyMenaeeCompletedStatusCount($month_no);
                //dd($monthly_pending_count);
                array_push($monthly_pending_count_array,$monthly_pending_count);
                array_push($monthly_completed_count_array,$monthly_completed_count);
                array_push($month_name_array,$month_name);
            }
        }
        //dd($month_name_array);

        if ($monthly_pending_count_array > $monthly_completed_count_array)
        {
            $max_no = max($monthly_pending_count_array);
        }
        else
        {
            $max_no = max($monthly_completed_count_array);
        }

        $max = round(($max_no + 10/2)/10) * 10;
        $monthly_east_africa_status_count_array = array(
            'months' => $month_name_array,
            'menaee_status_pending_count' => $monthly_pending_count_array,
            'menaee_status_completed_count' => $monthly_completed_count_array,
            'max' => $max,
        );
        //dd($monthly_east_africa_status_count_array);
        return $monthly_east_africa_status_count_array;
    }
    
    
    
    //-----------link for drill down ---------------
    public function employee_list_pending(Request $request)
    {
        //$request->replace(['screening_status' => '1']);
        //return view('employee_infos.index')->with(['screening_status' => '1']);
        return redirect()->route('employee_list',array('screening_status' => '1'));
        /*if ($pending != null)
        {
            
        }*/
        /*$request->replace(['screening_status' => '1']);

        dd($request->screening_status);
        //$this->search_employee($request);
        
        return view('employee_infos.index')->with(['screening_status' => '1']);*/

    }

    public function employee_list_completed(Request $request)
    {
        //$request->replace(['screening_status' => '1']);
        
        return redirect()->route('employee_list',array('screening_status' => '2'));

    }

    public function employee_list_employee(Request $request)
    {
        //$request->replace(['type_of_staff' => '1']);

        return redirect()->route('employee_list',array('type_of_staff' => 'Employee'));

    }

    public function employee_list_parttime(Request $request)
    {
        //$request->replace(['type_of_staff' => '1']);

        return redirect()->route('employee_list',array('type_of_staff' => 'Part-time'));

    }

    public function employee_list_consultant(Request $request)
    {
        //$request->replace(['type_of_staff' => '1']);

        return redirect()->route('employee_list',array('type_of_staff' => 'Consultant'));

    }

    public function employee_list_shortterm(Request $request)
    {
        //$request->replace(['type_of_staff' => '1']);

        return redirect()->route('employee_list',array('type_of_staff' => 'Short-term'));

    }

    public function employee_list_intern(Request $request)
    {
        //$request->replace(['type_of_staff' => '1']);

        return redirect()->route('employee_list',array('type_of_staff' => 'Intern'));

    }

    public function employee_list_volunteer(Request $request)
    {
        //$request->replace(['type_of_staff' => '1']);

        return redirect()->route('employee_list',array('type_of_staff' => 'Volunteer'));

    }


    public function employee_list_east_africa(Request $request)
    {
        //$request->replace(['screening_status' => '1']);

        return redirect()->route('employee_list',array('region_clicked' => '3'));

    }

    public function employee_list_west_africa(Request $request)
    {
        //$request->replace(['screening_status' => '1']);

        return redirect()->route('employee_list',array('region_clicked' => '2'));

    }

    public function employee_list_asia(Request $request)
    {
        //$request->replace(['screening_status' => '1']);

        return redirect()->route('employee_list',array('region_clicked' => '1'));

    }

    public function employee_list_menaee(Request $request)
    {
        //$request->replace(['screening_status' => '1']);

        return redirect()->route('employee_list',array('region_clicked' => '4'));

    }

    
}
