<?php

use App\Models\Screening_detail;

/**
 * Created by PhpStorm.
 * User: ahad.local
 * Date: 11/30/2021
 * Time: 5:45 PM
 */
class Helper_functions
{
    public function editLogger($loggerArray)
    {
        //dd($loggerArray['Updated_fields']);
        if ($loggerArray['type'] == 'info')
        {
            Log::info($loggerArray['Message'].' by user '.$loggerArray['p_UserName'],array
                (
                    'Message' => $loggerArray['Message'],
                    'p_UserName' => $loggerArray['p_UserName'],
                    'IP Address'=> $loggerArray['IP'],
                    'DateTime'=> date('Y-m-d H:i:s'),
                    'Response'=>$loggerArray['Response'],
                    'UpdatedData'=>$loggerArray['UpdatedData'],
                    'OldData'=>$loggerArray['OldData']
                )
            );
        }
    }


    public function insertLogger($loggerArray)
    {
        if ($loggerArray['type'] == 'info')
        {
            Log::info($loggerArray['Message'].' by user '.$loggerArray['p_UserName'],array
                (
                    'Message' => $loggerArray['Message'],
                    'p_UserName' => $loggerArray['p_UserName'],
                    'IP Address'=> $loggerArray['IP'],
                    'DateTime'=> date('Y-m-d H:i:s'),
                    'Response'=>$loggerArray['Response'],
                )
            );
        }
        elseif ($loggerArray['type'] == 'warning')
        {
            Log::warning('Validation error: '.$loggerArray['Message'].' by user '.$loggerArray['p_UserName'],array
                (
                    'Message' => $loggerArray['Message'],
                    'p_UserName' => $loggerArray['p_UserName'],
                    'IP Address'=> $loggerArray['IP'],
                    'DateTime'=> date('Y-m-d H:i:s'),
                    'Response'=>$loggerArray['Response'],
                )
            );
        }
    }


    public function alertLogger($loggerArray)
    {
        //dd($loggerArray['Updated_fields']);
        if ($loggerArray['type'] == 'alert')
        {
            Log::alert($loggerArray['Message'].' by user '.$loggerArray['p_UserName'],array
                (
                    'Message' => $loggerArray['Message'],
                    'p_UserName' => $loggerArray['p_UserName'],
                    'IP Address'=> $loggerArray['IP'],
                    'DateTime'=> date('Y-m-d H:i:s'),
                    'Response'=>$loggerArray['Response']
                )
            );
        }
    }



    public function type_of_staff($type)
    {
        return $employee = Screening_detail::where('type_of_staff', $type)
                ->count();
    }

    public function gender_region_wise($gender, $region_id)
    {
        return $male_east_africa = Screening_detail::whereHas('Employee_info',function ($query) use ($gender)
                {
                    $query->where('gender', $gender);
                }
                )->where('region_id',$region_id)
                ->count();
    }

    function employee_titles()
    {
        return array(
            'Consultant',
            'Employee',
            'Intern',
            'Part-time',
            'Short Term',
            'Volunteer'
        );
    }
}