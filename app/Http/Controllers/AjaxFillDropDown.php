<?php

namespace App\Http\Controllers;

use App\Jobs\SendQueueEmail;
use App\Models\Field_office;
use App\Models\Screening_comment;
use App\Models\Screening_detail;
use App\Models\Employee_info;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AjaxFillDropDown extends Controller
{
    //
    public function fillCountryDropDown(){
        $countries = Country::all();
        return response()->json(["status" => "success", "message" => "", "data" => $countries]);
                
    }

    public function fillNationalityDropDown(){
        $countries = Country::all();
        return response()->json(["status" => "success", "message" => "", "data" => $countries]);

    }

    public function fillEthnicityDropDown(){
        $countries = Country::all();
        return response()->json(["status" => "success", "message" => "", "data" => $countries]);

    }

    public function fillDepartmentDropDown(){
        $dept = Department::all();
        //$dept = Department::where('is_deleted','!=', '0');
        return response()->json(["status" => "success", "message" => "", "data" => $dept]);

    }

    public function fillDesignationDropDown(){
        $designation = Designation::all();
        //$designation = Designation::where('is_deleted','!=', '0');
        return response()->json(["status" => "success", "message" => "", "data" => $designation]);

    }

    public function fillUserDropDown(){
        $user = User::all();
        /*$user = User::where('is_deleted','!=', '0')
                        ->where('status','2');*/
        return response()->json(["status" => "success", "message" => "", "data" => $user]);

    }

    public function fillFieldOfficeByRegionDropDown(Request $req)
    {
        $region_id = $req->id;
        $field_office = Field_office::where('region_id','=',$region_id)->get();

        //$designation = Designation::where('is_deleted','!=', '0');
        return response()->json(["status" => "success", "message" => "", "data" => $field_office]);
    }

    public function fillUserFieldOfficeDropDown(Request $req)
    {
        $field_office_id = $req->user_field_office_id;

        //$new_user_field_office_id = json_decode($field_office_id, true);
        $new_user_field_office_id = explode(',',$field_office_id);
        //dd($new_user_field_office_id);
        
        $field_office = Field_office::whereIn('id',$new_user_field_office_id)->get();

        //$designation = Designation::where('is_deleted','!=', '0');
        return response()->json(["status" => "success", "message" => "", "data" => $field_office]);
    }

    public function find_screening_comments(Request $req)
    {
        $screening_detail_id = $req->screening_detail_id;
        $created_by = Auth::user()->id;
        //dd($screening_detail_id);

        $screening_comments = DB::select("select sc.*, u.name as created_by, (case when sc.created_by =". $created_by ." then 1 else 0 end) as allow_edit
                              from screening_comments sc
                              JOIN users u ON u.id = sc.created_by                            
                              WHERE sc.screening_detail_id = $screening_detail_id
                              ");

        //$designation = Designation::where('is_deleted','!=', '0');
        return response()->json(["status" => "success", "message" => "", "data" => $screening_comments]);
    }

    public function save_screening_comments(Request $req)
    {
        $id = $req->id;
        $screening_detail_id = $req->screening_detail_id;
        $created_by = Auth::user()->id;
        $description_comment = $req->description_comment;
        //dd($screening_detail_id);

        if ($id > 0)
        {

        }
        else
        {
            $data = array(
                'screening_detail_id' => $screening_detail_id
            , 'created_by' => $created_by
            , 'created_at' => Carbon::now()
            , 'description_comment' => $description_comment
            );

            $comment = DB::table('screening_comments')->insertGetId($data);//last insert id
        }


        //$this->send_email_insert_comment($screening_detail_id, $description_comment, $created_by);
        return response()->json(["status" => "success", "message" => "", "data" => $comment]);
    }

    public function delete_screening_comments(Request $req)
    {
        ///dd($req->all());
        $id = $req->id;
        //dd(url()->current());
        $data2 = Screening_comment::find($id);
        $data = Screening_comment::where('id',$id)->delete();

        //$data->delete();


        return response()->json(["status" => "success", "message" => "", "data" => $data]);
    }

    public function send_email_insert_comment(Request $req)
    {
        $screening_detail_id = $req->screening_detail_id;
        $description_comment = $req->description_comment;

        //dd($req->all());
        //---fetch details of screening and employee info
        $screening_data = Screening_detail::with(
            [
                //'designationsId',
                //'lineManagerDesignationsId',
                //'departmentsId',
                //'onBehalfUserId',
                //'scCreatedById',
                //'scUpdatedById',
                //'screeningStatusLogId',
                //'screeningStatusLogId.createdById',
                'regionId',
                'field_office',
                'Employee_info.countries',
                'Employee_info.nationalityId',
                //'Employee_info.ethnicityId',
                'Employee_info.createdById',
                'Employee_info.updatedById',
            ])->find($screening_detail_id);

        //$cc_emails = ['adil.shahzad@irp.org.pk', 'azeem.khan@irworldwide.org'];

        //--- get email address of those users who have region ALL access
        /*$all_region_users = User::select('email')
            ->where('region_id','0')
            ->where('screening_status_email','on')
            ->get();*/

        $final_field_office_email = array();// initialize an array - for final emails
        /*foreach ($all_region_users as $all_field)
        {
            // push element to one consolidate array
            array_push($final_field_office_email,$all_field->email);
        }*/

        //--- get email address of those users who have access of region which screening belong
        /*$specific_region_users = User::select('id','email', 'field_office_id')
            ->where('region_id', $screening_detail_id->region_id)
            ->where('screening_comment_email','on')
            ->get();*/


        //---finding email of users those have the screening field office access
        /*foreach ($specific_region_users as $field)
        {
            $arrField = explode(',', $field->field_office_id);

            foreach ($arrField as $rowKey=>$rowField)
            {
                if ($screening_data->field_office_id == $rowField)
                {
                    // push element to one consolidate array
                    array_push($final_field_office_email,$field->email);
                }
            }
        }*/
        $specific_region_users = User::select('id','email', 'region_id', 'field_office_id')
            ->where('screening_comment_email','on')
            ->whereIn('region_id', array($screening_data->region_id, 0))
            ->where('id', '!=', Auth::user()->id)

            ->get();

        //dd($specific_region_users);


        //---finding email of users those have the screening field office access
        foreach ($specific_region_users as $field)
        {
            if ($field->region_id > 0)
            {
                $arrField = explode(',', $field->field_office_id);

                foreach ($arrField as $rowKey=>$rowField)
                {
                    if ($screening_data->field_office_id == $rowField)
                    {
                        // push element to one consolidate array
                        array_push($final_field_office_email,$field->email);
                    }
                }
            }
            else
            {
                array_push($final_field_office_email,$field->email);
            }

        }

        //dd(url()->current());
        $url = config('app.url');

        $details = [
            'title' => 'Mail from Global Screening Database',
            'subject'   => 'Some Comment Written',
            'to'    => $final_field_office_email,
            //'cc'    => 'adil.shahzad@irp.org.pk; azeem.khan@irworldwide.org',
            //'cc'    => $cc_emails,
            'employee_name' => $screening_data->Employee_info->employee_name,
            'employee_surname' => $screening_data->Employee_info->employee_surname,
            'reference_no'  => $screening_data->reference_no,
            'nic'   => $screening_data->Employee_info->nic,
            'region'    => $screening_data->regionId->name,
            'field_office'    => $screening_data->field_office->name,

            /*'staff_type'    => $screening_data->type_of_staff,
            'designation'    => $screening_data->designationsId->name,
            'department'    => $screening_data->departmentsId->name,
            'line_manager'    => $screening_data->lineManagerDesignationsId->name,*/
            'comment'    => $description_comment,
            'comment_by'    => Auth::user()->name,
            'email_link'    => $url.'/screening_view/'.$screening_data->id,
        ];

        //dd($details);

        //Mail::send(new SendMail($details));
        /*Mail::send('emails.email_insert_comment', $details, function($message) use ($details) {
            $message->to($details['to']);
            //$message->cc($details['cc']);
            $message->subject($details['subject']);
            //$message->subject($details['message']);
        });*/

        $location = 'comment';

        $job = (new SendQueueEmail($details, $location))->delay(Carbon::now()->addSeconds(5));
        //dd($details);

        //dd($job);
        dispatch($job);

        return response()->json(["status" => "success", "message" => "", "data" => ""]);
        //return redirect('screening_view/'.$screening);
    }
}
