<?php

namespace App\Http\Controllers;

use App\Models\EmployeeInfo;
use App\Models\ScreeningDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Field_office;
use App\Models\Employee_info;
use App\Models\Screening_detail;
use App\Models\Screening_document_detail_checklist;
use App\Models\Screening_status_log;
use App\Models\Screening_comment;

use App\Jobs\SendQueueEmail;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;

use Carbon\Carbon;
use Helper_functions;


class ScreeningController extends Controller
{
    //insert
    public function add_screening_2($employee_info_id)
    {
        $employee = Employee_info::find($employee_info_id);

        if(is_null($employee))
        {
            flash('Sorry, employee does not exist!')->error();
            return redirect('/employee_list');
        }

        $employees_array = $employee['screening']; //picking relation values - model employeeInfo, func name screening


        $plucked = $employees_array->pluck('screening_status');
        $statuses = $plucked->all();
        //dd($statuses);
        $add_screening = true;
        if(in_array(1, $statuses))
            $add_screening = false;


        if(!$add_screening)
        {
            flash('Sorry, screening already under process! Please contact administrator')->error();
            return redirect('/employee_view/'.$employee_info_id);
        }


        $designations = DB::table('designations')->select('id','name')->get();
        $departments = DB::table('departments')->select('id','name')->get();
        $regions = DB::table('regions')->select('id','name')->get();
        $users = DB::table('users')->select('id','name')->where('is_deleted',0)->get();
        return view('screening.add_screening_2')
            ->with(['employee'=>$employee, 'designations'=>$designations, 'departments'=>$departments, 
                'users'=>$users, 'regions'=>$regions]);
    }

    public function insert_screening_2(Request $request , $employee_info_id)
    {
        /*$fileSize = ini_get('upload_max_filesize');//get default file size from php.ini
        dd($fileSize);*/

        //dd($request->all());
        $validator = Validator::make($request->all(),[
            'type_of_staff'             => 'required',
            'designation'               => 'required',
            'department'                => 'required',
            'line_manager_designation'  => 'required',
            //'contract_start_date'       => 'required',
            //'family_size'               => 'required',
            'region_id'             => 'required',
            'field_office_id'       => 'required',

            'file_attachment_nic' => 'required|file|max:2000',
            //'file_attachment_nic' => 'required|file|'.$fileSize,
            //'expiry_date' => 'sometime|required',
            //'files.*' => 'mimes:csv,txt,xlx,xls,pdf,gif,jpg,jpeg,png,doc,xml,docx,xlxs,ppt,bmp,msg,GIF,JPG,JPEG,PNG,PDF,XML,DOCX',

            //'file_attachment_police' => 'exclude_if:file_attachment_nic,true|required|file',
            'file_attachment_police'  => 'sometimes|required|file|max:2000'
        ]);

        if ($validator->fails()) {
            //dd($validator->error());
            flash('Required fields are missing')->error();
            return back()->withErrors($validator)
                ->withInput();

        }
        else
        {
            $file_attachment_nic = $request->file_attachment_nic;

            if (isset($request->valid_for_life_time))
            {
                $valid_for_life_time = $request->valid_for_life_time;
            }
            else
            {
                $valid_for_life_time = 'No';
            }

            if (isset($request->expiry_date))
            {
                $expiry_date = date('Y-m-d', strtotime($request->expiry_date));
                //$job_status = 'Previous';
            }
            else
            {
                $expiry_date = null;
                //$job_status = 'Current';
            }
            //$expiry_date = $request->expiry_date;

            if ($file_attachment_nic == null)
            {
                flash('NIC Attachments fields is missing')->error();
                return back()->withInput();
            }

            if($expiry_date == null && $valid_for_life_time != 'Yes')
            {
                flash('Mark expiry date if it is not valid for life time or check the checkbox')->error();
                return back()->withInput();
            }
            

            //$questions = json_encode($request->family_size);

            //*********** check screening exists *********************
            // 1. if exist, in pending or in-progress status then stop submission
            // 2. if found in completed status then insert and update old record as archive

            $result = Screening_detail::where('employee_info_id','=',$employee_info_id)
                ->where('screening_status','=','2')
                ->where('record_status','!=','2')
                ->get();


            //dd($result->count());
            //---update old screening to be archive if exists
            if ($result->count() > 0)
            {
                $data = array(
                    'record_status' => '2',//archive
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                );


                DB::table('screening_details')
                    ->where('employee_info_id', $employee_info_id)
                    ->update($data);

                $arr = $result->toarray();
                $change_data = array_diff_assoc($data,$arr[0]);
                //dd($arr[0],$data, $change_data);

                //-----Log entry
                $loggerArray = ['type' => 'info', 'IP' => $request->ip(),
                    'Message' =>'Screening - Old screening of employee marked as archive',
                    'p_UserName' => Auth::user()->name,
                    'Response' =>$data,
                    'UpdatedData' => $change_data,
                    'OldData' => $arr[0]
                ];

                $loggerHelper = new Helper_functions();
                $check = $loggerHelper->editLogger($loggerArray);
            }

            //---------------------------------------------------------------------------------------
            //------ Get short name of field office - Reference no --------------
            $field_office_id = $request->field_office_id;
            $fieldOfficeData = Field_office::find($field_office_id);

            //********** Generated reference num ***********************************
            $acronym_name = $fieldOfficeData->acronym;//TR
            $sequence_no = $fieldOfficeData->sequence_number;//364
            $max_count = Screening_detail::where('field_office_id',$request->field_office_id)->count() + 1; //10
            $code = $sequence_no + $max_count;
            $ref_no = $acronym_name.$code;

            //--------------------------------------------------------------------

            //insert new screening record
            $data = array(
                'employee_info_id'          => $employee_info_id,
                'reference_no'              => $ref_no,
                'region_id'                 => $request->region_id,
                'designation_id'            => $request->designation,
                'type_of_staff'             => $request->type_of_staff,
                'field_office_id'           => $request->field_office_id,
                'department_id'             => $request->department,
                'line_manager_designation'  => $request->line_manager_designation,
                'contract_start_date'       => $request->contract_start_date,
                'contract_end_date'         => $request->contract_end_date,
                // 'screening_result'          => ,
                'screening_date'            => Carbon::now(),
                'comments'                  => $request->comments,
                //'questions'                 => $questions,
                'screening_status'          => 1,
                'employee_status'           => 0,//pending
                'record_status'             => 1,
                'on_behalf_user'            => $request->on_behalf_user,
                'created_by'        => Auth::user()->id,
                'created_at'        => Carbon::now(),
                //'updated_by'        => Auth::user()->id,
                //'updated_at'        => Carbon::now(),
            );

            $screening = DB::table('screening_details')->insertGetId($data);//last insert id

            //-----Log entry
            $loggerArray = ['type' => 'info', 'IP' => $request->ip(),
                'Message' =>'Screening - New screening record insertion',
                'p_UserName' => Auth::user()->name,
                'Response' =>$data,
            ];

            $loggerHelper = new Helper_functions();
            $check = $loggerHelper->insertLogger($loggerArray);


            //--- insert status log - pending and generate reference no
            if ($screening > 0)
            {

                $statusLogData = array(
                    'screening_detail_id' => $screening,
                    'screening_status_id' => 1,
                    'description' => $request->comments,
                    'status_date' => Carbon::now(),
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                );


                DB::table('screening_status_logs')->insert($statusLogData);

                //-----Log entry
                $loggerArray = ['type' => 'info', 'IP' => $request->ip(),
                    'Message' =>'Screening - New screening status log insertion',
                    'p_UserName' => Auth::user()->name,
                    'Response' =>$statusLogData,
                ];

                $loggerHelper = new Helper_functions();
                $check = $loggerHelper->insertLogger($loggerArray);


                //---------------------------------------------------------------------------------------
                //************************** Changes 26 May 2022 **************************************
                //-------------------- File Uploading with screening insertion --------------------------

                if ($request->hasFile('file_attachment_nic'))
                {
                    $file      = $request->file('file_attachment_nic');

                    $expiry_date = $request->expiry_date;
                    $path = storage_path('app/public/screening_attachments/'. $screening);

                    //--- make directory if not found
                    if(!File::isDirectory($path)){

                        File::makeDirectory($path, 0777, true, true);

                    }
                    $path = $file->store('public/screening_attachments/'. $screening );
                    $name = $file->getClientOriginalName();
                    $insert['attachment'] = $name;
                    $insert['store_path'] = $path;
                    $insert['screening_detail_id'] = $screening;
                    $insert['valid_for_life_time'] = $valid_for_life_time;
                    $insert['expiry_date'] = $expiry_date;
                    $insert['screening_document_checklist_id'] = '1';//Passport/NIC

                    $insert['created_by'] = Auth::user()->id;
                    $insert['created_at'] = date('Y-m-d');

                    Screening_document_detail_checklist::insert($insert);
                }

                if ($request->hasFile('file_attachment_police'))
                {
                    $file5      = $request->file('file_attachment_police');

                    $path5 = storage_path('app/public/screening_attachments/'. $screening);

                    //--- make directory if not found
                    if(!File::isDirectory($path5)){

                        File::makeDirectory($path5, 0777, true, true);

                    }
                    $path5 = $file5->store('public/screening_attachments/'. $screening );
                    $name = $file5->getClientOriginalName();
                    $insert5['attachment'] = $name;
                    $insert5['store_path'] = $path5;
                    $insert5['screening_detail_id'] = $screening;
                    $insert5['screening_document_checklist_id'] = '5';//Passport/NIC

                    $insert5['created_by'] = Auth::user()->id;
                    $insert5['created_at'] = date('Y-m-d');

                    Screening_document_detail_checklist::insert($insert5);
                }
            }

            //--- Email Sending
            //$this->send_email_add_screening($screening);
            // --- the below method call from task schedular and cron
            // --- 17 Dec, 2021
            $this->send_bulk_email_add_screening($screening);

            return redirect('screening_view/'.$screening);
        }
    }

    //edit
    public function edit_screening_2($employee_info_id, $screening_id)
    {
        $user_region = Auth::user()->region_id;
        $user_field_offices = Auth::user()->field_office_id;
        $new_user_field_offices = explode(',',$user_field_offices);

        if ($user_region == 0)
        {
            $regions = DB::table('regions')->select('id','name')->get();
        }
        else
        {
            $regions = DB::table('regions')->select('id','name')->where('id',$user_region)->get();
        }
        //$regions = DB::table('regions')->select('id','name')->where('id',$user_region)->get();

        if ($user_field_offices == '' || $user_field_offices == null)
        {
            $field_offices = DB::table('field_offices')->select('id','name', 'acronym')->get();
        }
        else
        {
            $field_offices = DB::table('field_offices')->select('id','name', 'acronym')
                ->whereIn('id',$new_user_field_offices)
                ->get();
        }

        $screening = DB::table('screening_details')->where('id',$screening_id)->first();
        $employee = DB::table('employee_infos')->select('id')->where('id',$employee_info_id)->first();
        $designations = DB::table('designations')->select('id','name')->get();
        $departments = DB::table('departments')->select('id','name')->get();
        $users = DB::table('users')->select('id','name')->where('is_deleted',0)->get();
        return view('screening.edit_screening_2')
            ->with(['employee'=>$employee, 'designations'=>$designations, 'departments'=>$departments,
                'users'=>$users, 'screening'=>$screening, 'regions'=>$regions,
                'field_offices'=>$field_offices]);
    }

    public function update_screening_2(Request $request , $screening_id)
    {
        //dd($request->all());
        $validated = $request->validate([
            'region_id'             => 'required',
            //'field_office_id'       => 'required',
            'type_of_staff'             => 'required',
            'designation'               => 'required',
            'department'                => 'required',
            'line_manager_designation'  => 'required',
            //'contract_start_date'       => 'required',
            //'family_size'               => 'required',
        ]);
        //$questions = json_encode($request->family_size);

        /*$data = array(
            'type_of_staff'             => $request->type_of_staff,
            'designation_id'            => $request->designation,
            'department_id'             => $request->department,
            'line_manager_designation'  => $request->line_manager_designation,
            'contract_start_date'       => $request->contract_start_date,
            'contract_end_date'         => $request->contract_end_date,
            // 'screening_result'          => ,
            'screening_date'            => Carbon::now(),
            'comments'                  => $request->comments,
            //'questions'                 => $questions,
            //'screening_status'          => 1,
            //'employee_status'           => 1,
            //'record_status'             => 1,
            'on_behalf_user'            => $request->on_behalf_user,
            'updated_by'        => Auth::user()->id,
            'updated_at'        => Carbon::now(),
        );

        DB::table('screening_details')
            ->where('id', $screening_id)
            ->update($data);*/

        $old_field_office_id = $request->old_field_office_id;
        $field_office_id = $request->field_office_id;



        if ($field_office_id == null)
        {
            $field_office_id = $old_field_office_id;
            $reference_no = $request->reference_no;
        }


        if ($old_field_office_id != $field_office_id)
        {
            $fieldOfficeData = Field_office::find($field_office_id);
            //********** Generated reference num ***********************************
            $acronym_name = $fieldOfficeData->acronym;//TR
            $sequence_no = $fieldOfficeData->sequence_number;//364
            $max_count = Screening_detail::where('field_office_id',$request->field_office_id)->count() + 1;
            $code = $sequence_no + $max_count;
            $reference_no = $acronym_name.$code;
            
        }
        else
        {
            $reference_no = $request->reference_no;
        }
        
        $screen_edit = Screening_detail::find($screening_id);

        $screen_edit->reference_no = $reference_no;
        $screen_edit->region_id = $request->region_id;
        $screen_edit->field_office_id = $field_office_id;
        $screen_edit->type_of_staff     =   $request->type_of_staff;
        $screen_edit->designation_id     =   $request->designation;
        $screen_edit->department_id     =   $request->department;
        $screen_edit->line_manager_designation     =   $request->line_manager_designation;
        $screen_edit->contract_start_date     =   $request->contract_start_date;
        $screen_edit->contract_end_date     =   $request->contract_end_date;

        if ($request->employee_status == null)
        {
            $screen_edit->employee_status     = '0';
        }
        else
        {
            $screen_edit->employee_status     =   $request->employee_status;
        }
        //
        $screen_edit->comments     =   $request->comments;
        $screen_edit->on_behalf_user     =   $request->on_behalf_user;
        $screen_edit->updated_by     =   Auth::user()->id;
        $screen_edit->updated_at     =   Carbon::now();


        $old_record = $screen_edit->getOriginal();// get old records
        $change_data = array_diff($old_record,$screen_edit->toarray());

        $screen_edit->save();

        $updated_fields = $screen_edit->getChanges();// get edited fields


        //-----Log entry
        $loggerArray = ['type' => 'info', 'IP' => $request->ip(),
            'Message' =>'Screening - Screening record updated',
            'p_UserName' => Auth::user()->name,
            'Response' =>$screen_edit,
            'UpdatedData' => $updated_fields,
            'OldData' => $change_data
        ];

        $loggerHelper = new Helper_functions();
        $check = $loggerHelper->editLogger($loggerArray);

        return redirect('employee_view/'.$request->employee_info_id);
    }
    

    //---open view detail page
    public function view_details_screening($id)
    {
        $created_by = Auth::user()->id;
        //return view('screening.view_details_screening');
        /*$data = DB::select("select sd.* from vwscreeningdetails sd
                              WHERE sd.record_status = 1
                              AND sd.screening_detail_id = $id
                              ");*/

        $screening = Screening_detail::with(
            [
                'designationsId',
                'lineManagerDesignationsId',
                'regionId',
                'field_office',
                'departmentsId',
                'onBehalfUserId',
                'scCreatedById',
                'scUpdatedById',
                'screeningStatusLogId',
                'screeningStatusLogId.createdById',
                'Employee_info.countries',
                'Employee_info.nationalityId',
                //'Employee_info.ethnicityId',
                'Employee_info.createdById',
                'Employee_info.updatedById',
                'ScreeningDocumentDetail',
            ])->find($id);

        //dd($screening);


        $screening_status_name = '';
        $screening_status = $screening->screening_status;
        if ($screening_status == 1)
        {
            $screening_status_name = 'Pending';
        }
        /*elseif ($screening_status == 2)
        {
            $screening_status_name = 'In-progress';
        }*/
        elseif ($screening_status == 2)
        {
            $screening_status_name = 'Completed';
        }


        $employee_status_name = '';
        $employee_status = $screening->employee_status;
        if ($employee_status == 0)
        {
            $employee_status_name = 'Pending';
        }
        elseif ($employee_status == 1)
        {
            $employee_status_name = 'Active';
        }
        elseif ($employee_status == 2)
        {
            $employee_status_name = 'Leaver';
        }

        if(is_null($screening))
        {
            flash('Sorry, screening does not exist!')->error();
            return redirect()->back();
        }


        $file_nic = DB::select("select sdc.*, SUBSTRING_INDEX(sdc.store_path, '/', -1) as file_name, u.name as created_by, (case when sdc.created_by =". $created_by ." then 1 else 0 end) as allow_edit
                              from screening_document_detail_checklists sdc
                              JOIN users u ON u.id = sdc.created_by
                              WHERE sdc.screening_document_checklist_id = 1
                              AND sdc.screening_detail_id = $id
                              ");

        $file_resume = DB::select("select sdc.*, SUBSTRING_INDEX(sdc.store_path, '/', -1) as file_name, u.name as created_by, (case when sdc.created_by =". $created_by ." then 1 else 0 end) as allow_edit
                              from screening_document_detail_checklists sdc
                              JOIN users u ON u.id = sdc.created_by
                              WHERE sdc.screening_document_checklist_id = 2
                              AND sdc.screening_detail_id = $id
                              ");

        $file_qualification = DB::select("select sdc.*, SUBSTRING_INDEX(sdc.store_path, '/', -1) as file_name, u.name as created_by, (case when sdc.created_by =". $created_by ." then 1 else 0 end) as allow_edit
                              from screening_document_detail_checklists sdc
                              JOIN users u ON u.id = sdc.created_by
                              WHERE sdc.screening_document_checklist_id = 3
                              AND sdc.screening_detail_id = $id
                              ");

        $file_experience = DB::select("select sdc.*, SUBSTRING_INDEX(sdc.store_path, '/', -1) as file_name, u.name as created_by, (case when sdc.created_by =". $created_by ." then 1 else 0 end) as allow_edit
                              from screening_document_detail_checklists sdc
                              JOIN users u ON u.id = sdc.created_by
                              WHERE sdc.screening_document_checklist_id = 4
                              AND sdc.screening_detail_id = $id
                              ");

        $file_police = DB::select("select sdc.*, SUBSTRING_INDEX(sdc.store_path, '/', -1) as file_name, u.name as created_by, (case when sdc.created_by =". $created_by ." then 1 else 0 end) as allow_edit
                              from screening_document_detail_checklists sdc
                              JOIN users u ON u.id = sdc.created_by
                              WHERE sdc.screening_document_checklist_id = 5
                              AND sdc.screening_detail_id = $id
                              ");

        $file_other = DB::select("select sdc.*, SUBSTRING_INDEX(sdc.store_path, '/', -1) as file_name, u.name as created_by, (case when sdc.created_by =". $created_by ." then 1 else 0 end) as allow_edit
                              from screening_document_detail_checklists sdc
                              JOIN users u ON u.id = sdc.created_by
                              WHERE sdc.screening_document_checklist_id = 6
                              AND sdc.screening_detail_id = $id
                              ");


        return view('screening.view_details_screening',['screening'=>$screening
                                                        ,'screening_status_name'=>$screening_status_name
                                                        ,'employee_status_name'=>$employee_status_name
                                                        , 'file_nic'=>$file_nic
                                                        , 'file_resume'=>$file_resume
                                                        , 'file_qualification'=>$file_qualification
                                                        , 'file_experience'=>$file_experience
                                                        , 'file_police'=>$file_police
                                                        , 'file_other'=>$file_other
        ]);
    }

    // --- update In-progress status marking - MODAL
    //************************************************
    /*public function update_modal_inprogress(Request $req)
    {
        //dd($req->all());
        // initial form saved
        $req->validate([
            'screening_detail_id'=>'required',
            'status_date'=>'required',
            'comment'=>'required',
        ]);

        $screening_detail_id = $req->screening_detail_id;
        $screening_status = $req->screening_status_id;
        $status_date = $req->status_date;
        $desc = $req->comment;

        if ($screening_detail_id > 0 && $screening_status == 1)//Pending
        {
            $modalUpdate = Screening_detail::find($screening_detail_id);

            //$user = new User;
            $modalUpdate->screening_status = '2';//---mark In-progress
            $modalUpdate->updated_by = Auth::user()->id;
            $modalUpdate->updated_at = date('Y-m-d');

            $modalUpdate->save();

            //----- insert status log
            $statusLog = new Screening_status_log();
            $statusLog->screening_detail_id = $screening_detail_id;
            $statusLog->screening_status_id = 2;
            $statusLog->description = $desc;
            $statusLog->status_date = $status_date;
            $statusLog->created_by = Auth::user()->id;
            $statusLog->created_at = Carbon::now();

            $statusLog->save();


            return redirect("screening_view/{$screening_detail_id}")->with('Form has been inserted',$modalUpdate);
        }
        //return view('user.index');
    }*/

    // --- update In-progress status marking - MODAL
    //************************************************
    public function update_modal_completed(Request $req)
    {
        //dd($req->all());
        // initial form saved
        $validator = Validator::make($req->all(), [
            'screening_detail_id'   => 'required',
            //'status_date'           => 'required',
            'screening_result'      => 'required',
            'screening_date'        => 'required',
            'comment'               => 'required',
        ]);

        if ($validator->fails()) {
            //dd($validator->erro());
            flash('Required fields are missing')->error();
            return back()->withErrors($validator)
                ->withInput();

        }
        else
        {
            /*$validate = $req->validate([
                        'screening_detail_id'   => 'required',
                        'status_date'           => 'required',
                        'screening_result'      => 'required',
                        'screening_date'        => 'required',
                        'comment'               => 'required',
                    ]);
                    */

            $screening_detail_id = $req->screening_detail_id;
            $screening_status = $req->screening_status_id;
            $status_date = $req->screening_date;
            $desc = $req->comment;

            if ($screening_detail_id > 0 && $screening_status == 1)//Pending
            {
                $modalUpdate = Screening_detail::find($screening_detail_id);

                $modalUpdate->screening_status = '2';//---mark Completed
                $modalUpdate->screening_result = $req->screening_result;
                $modalUpdate->screening_date = $req->screening_date;
                $modalUpdate->updated_by = Auth::user()->id;
                $modalUpdate->updated_at = date('Y-m-d');

                $old_record = $modalUpdate->getOriginal();// get old records
                $change_data = array_diff_assoc($old_record,$modalUpdate->toarray());

                $modalUpdate->save();
                $updated_fields = $modalUpdate->getChanges();// get edited fields

                //-----Log entry
                $loggerArray = ['type' => 'info', 'IP' => $req->ip(),
                    'Message' =>'Screening - Status updated',
                    'p_UserName' => Auth::user()->name,
                    'Response' =>$modalUpdate,
                    'UpdatedData' => $updated_fields,
                    'OldData' => $change_data
                ];

                $loggerHelper = new Helper_functions();
                $check = $loggerHelper->editLogger($loggerArray);

                //---insert Log
                $statusLog = new Screening_status_log();
                $statusLog->screening_detail_id = $screening_detail_id;
                $statusLog->screening_status_id = 2;
                $statusLog->description = $desc;
                $statusLog->status_date = $status_date;// as screening date
                $statusLog->created_by = Auth::user()->id;
                $statusLog->created_at = Carbon::now();

                $statusLog->save();

                //---- sent email on status change --- //
                $this->send_email_screening_status_change($screening_detail_id);

                return redirect("screening_view/{$screening_detail_id}")->with('Form has been inserted',$modalUpdate);
            }
        }

    }
    
    //*********************************** Attachments *************************************************
    //--- 1. attach nic
    public function save_attachment_nic(Request $request)
    {
        //$data = "";
        // if($request->expiry_date == null)
        // {
        //     $data = [
        //         'status' => 'error',
        //         'message'=> 'Your AJAX processed correctly'
        //       ] ;
        //     return response()->json($data);
        // }

        //dd ($request->all());
        $validatedData = $request->validate([
            'file_attachment_nic' => 'file|required|max:2000',
            //'expiry_date' => 'required',
            'files.*' => 'mimes:csv,txt,xlx,xls,pdf,gif,jpg,jpeg,png,doc,xml,docx,xlxs,ppt,bmp,msg,GIF,JPG,JPEG,PNG,PDF,XML,DOCX'
        ]);

        //return response()->json([validatedData->error()]);

        if (isset($request->valid_for_life_time))
        {
            $valid_for_life_time = $request->valid_for_life_time;
        }
        else
        {
            $valid_for_life_time = 'No';
        }

        if (isset($request->expiry_date))
        {
            $expiry_date = date('Y-m-d', strtotime($request->expiry_date));
            //$job_status = 'Previous';
        }
        else
        {
            $expiry_date = null;
            //$job_status = 'Current';
        }
        

        //dd($request->expiry_date);
        if($request->TotalFiles > 0)
        {
            $screening_detail_id = $request->screening_detail_id;

            for ($x = 0; $x < $request->TotalFiles; $x++)
            {
                if ($request->hasFile('files'.$x))
                {
                    $file      = $request->file('files'.$x);
                    //$screening_document_checklist_id = $request->screening_document_checklist_id;
                    $expiry_date = $request->expiry_date;
                    $path = storage_path('app/public/screening_attachments/'. $screening_detail_id);
                    //--- make directory if not found
                    if(!File::isDirectory($path)){

                        File::makeDirectory($path, 0777, true, true);

                    }
                    $path = $file->store('public/screening_attachments/'. $screening_detail_id );
                    $name = $file->getClientOriginalName();
                    $insert[$x]['attachment'] = $name;
                    $insert[$x]['store_path'] = $path;
                    $insert[$x]['screening_detail_id'] = $screening_detail_id;
                    $insert[$x]['valid_for_life_time'] = $valid_for_life_time;
                    $insert[$x]['expiry_date'] = $expiry_date;
                    $insert[$x]['screening_document_checklist_id'] = '1';//Passport/NIC

                    $insert[$x]['created_by'] = Auth::user()->id;
                    $insert[$x]['created_at'] = date('Y-m-d');
                }
            }

                Screening_document_detail_checklist::insert($insert);
            return response()->json(['message'=>'File has been uploaded', 'status'=>'success', "data" => "file_upload"]);

        }
        else
        {
            $data = [
                'status' => 'error',
                'message'=> 'Please Attach File'
              ] ;
            return response()->json($data);
            //return response()->json(["status"=>"error","data" => "file_empty", "messgae"=>"file_empty"]);
        }
    }

    //--- 2. attach resume
    public function save_attachment_resume(Request $request)
    {

        //dd ($request->all());
        $validatedData = $request->validate([
            'file_attachment_resume' => 'file|required|max:2000',
            ]);
        if($request->TotalFiles > 0)
        {
            $screening_detail_id = $request->screening_detail_id;

            for ($x = 0; $x < $request->TotalFiles; $x++)
            {
                if ($request->hasFile('files'.$x))
                {
                    $file      = $request->file('files'.$x);
                    //$screening_document_checklist_id = $request->screening_document_checklist_id;
                    $path = storage_path('app/public/screening_attachments/'. $screening_detail_id);
                    //--- make directory if not found
                    if(!File::isDirectory($path)){

                        File::makeDirectory($path, 0777, true, true);

                    }
                    $path = $file->store('public/screening_attachments/'. $screening_detail_id );
                    $name = $file->getClientOriginalName();
                    $insert[$x]['attachment'] = $name;
                    $insert[$x]['store_path'] = $path;
                    $insert[$x]['screening_detail_id'] = $screening_detail_id;
                    $insert[$x]['screening_document_checklist_id'] = '2';//Resume

                    $insert[$x]['created_by'] = Auth::user()->id;
                    $insert[$x]['created_at'] = date('Y-m-d');
                }
            }

            Screening_document_detail_checklist::insert($insert);
            return response()->json(['message'=>'File has been uploaded', 'status'=>'success']);
        }
        else
        {
            return response()->json(["message" => "Please try again."]);
        }
    }

    //--- 3. attach qualification
    public function save_attachment_qualification(Request $request)
    {

        //dd ($request->all());
        $validatedData = $request->validate([
            'file_attachment_qualification' => 'file|required|max:2000',
        ]);
        if($request->TotalFiles > 0)
        {
            $screening_detail_id = $request->screening_detail_id;

            for ($x = 0; $x < $request->TotalFiles; $x++)
            {
                if ($request->hasFile('files'.$x))
                {
                    $file      = $request->file('files'.$x);
                    //$screening_document_checklist_id = $request->screening_document_checklist_id;
                    $path = storage_path('app/public/screening_attachments/'. $screening_detail_id);
                    //--- make directory if not found
                    if(!File::isDirectory($path)){

                        File::makeDirectory($path, 0777, true, true);

                    }
                    $path = $file->store('public/screening_attachments/'. $screening_detail_id );
                    $name = $file->getClientOriginalName();
                    $insert[$x]['attachment'] = $name;
                    $insert[$x]['store_path'] = $path;
                    $insert[$x]['screening_detail_id'] = $screening_detail_id;
                    $insert[$x]['screening_document_checklist_id'] = '3';//qualification

                    $insert[$x]['created_by'] = Auth::user()->id;
                    $insert[$x]['created_at'] = date('Y-m-d');
                }
            }

            Screening_document_detail_checklist::insert($insert);
            return response()->json(['message'=>'File has been uploaded', 'status'=>'success']);
        }
        else
        {
            return response()->json(["message" => "Please try again."]);
        }
    }

    //--- 4. attach experience
    public function save_attachment_experience(Request $request)
    {
        //$fileSize = ini_get('upload_max_filesize');

        //dd ($request->all());
        $validatedData = $request->validate([
            'file_attachment_experience' => 'file|required|max:2000',
        ]);
        if($request->TotalFiles > 0)
        {
            $screening_detail_id = $request->screening_detail_id;

            for ($x = 0; $x < $request->TotalFiles; $x++)
            {
                if ($request->hasFile('files'.$x))
                {
                    $file      = $request->file('files'.$x);
                    //$screening_document_checklist_id = $request->screening_document_checklist_id;
                    $path = storage_path('app/public/screening_attachments/'. $screening_detail_id);
                    //--- make directory if not found
                    if(!File::isDirectory($path)){

                        File::makeDirectory($path, 0777, true, true);

                    }
                    $path = $file->store('public/screening_attachments/'. $screening_detail_id );
                    $name = $file->getClientOriginalName();
                    $insert[$x]['attachment'] = $name;
                    $insert[$x]['store_path'] = $path;
                    $insert[$x]['screening_detail_id'] = $screening_detail_id;
                    $insert[$x]['screening_document_checklist_id'] = '4';//Experience

                    $insert[$x]['created_by'] = Auth::user()->id;
                    $insert[$x]['created_at'] = date('Y-m-d');
                }
            }

            Screening_document_detail_checklist::insert($insert);
            return response()->json(['message'=>'File has been uploaded', 'status'=>'success']);
        }
        else
        {
            return response()->json(["message" => "Please try again."]);
        }
    }

    //--- 5. attach police character certificate
    public function save_attachment_police(Request $request)
    {

        //dd ($request->all());
        $validatedData = $request->validate([
            'file_attachment_police' => 'file|required|max:2000',
        ]);
        if($request->TotalFiles > 0)
        {
            $screening_detail_id = $request->screening_detail_id;

            for ($x = 0; $x < $request->TotalFiles; $x++)
            {
                if ($request->hasFile('files'.$x))
                {
                    $file      = $request->file('files'.$x);
                    //$screening_document_checklist_id = $request->screening_document_checklist_id;
                    $path = storage_path('app/public/screening_attachments/'. $screening_detail_id);
                    //--- make directory if not found
                    if(!File::isDirectory($path)){

                        File::makeDirectory($path, 0777, true, true);

                    }
                    $path = $file->store('public/screening_attachments/'. $screening_detail_id );
                    $name = $file->getClientOriginalName();
                    $insert[$x]['attachment'] = $name;
                    $insert[$x]['store_path'] = $path;
                    $insert[$x]['screening_detail_id'] = $screening_detail_id;
                    $insert[$x]['screening_document_checklist_id'] = '5';//Police Character Certificate

                    $insert[$x]['created_by'] = Auth::user()->id;
                    $insert[$x]['created_at'] = date('Y-m-d');
                }
            }

            Screening_document_detail_checklist::insert($insert);
            return response()->json(['message'=>'File has been uploaded', 'status'=>'success']);
        }
        else
        {
            return response()->json(["message" => "Please try again."]);
        }
    }

    //--- 6. attach other
    public function save_attachment_other(Request $request)
    {

        //dd ($request->all());
        $validator = Validator::make($request->all(),[
            
            'file_attachment_other' => 'required|file|max:2000',
            
        ]);

        if ($validator->fails()) {
            //dd($validator->erro());
            //return response()->json(['message'=>'File size should be below 5mb', 'status'=>'fail']);
            

        }
        else
        {
            if($request->TotalFiles > 0)
            {
                $screening_detail_id = $request->screening_detail_id;

                for ($x = 0; $x < $request->TotalFiles; $x++)
                {
                    if ($request->hasFile('files'.$x))
                    {
                        $file      = $request->file('files'.$x);
                        //$screening_document_checklist_id = $request->screening_document_checklist_id;
                        $path = storage_path('app/public/screening_attachments/'. $screening_detail_id);
                        //--- make directory if not found
                        if(!File::isDirectory($path)){

                            File::makeDirectory($path, 0777, true, true);

                        }
                        $path = $file->store('public/screening_attachments/'. $screening_detail_id );
                        $name = $file->getClientOriginalName();
                        $insert[$x]['attachment'] = $name;
                        $insert[$x]['store_path'] = $path;
                        $insert[$x]['screening_detail_id'] = $screening_detail_id;
                        $insert[$x]['screening_document_checklist_id'] = '6'; // Other

                        $insert[$x]['created_by'] = Auth::user()->id;
                        $insert[$x]['created_at'] = date('Y-m-d');
                    }
                }

                Screening_document_detail_checklist::insert($insert);
                return response()->json(['message'=>'File has been uploaded', 'status'=>'success']);
            }
            else
            {
                return response()->json(["message" => "Please try again."]);
            }  
        }
        
    }


    public function find_attachment_nic(Request $request)
    {
        $screening_detail_id = $request->screening_detail_id;
        $document_id = $request->document_id;
        $created_by = Auth::user()->id;
        $data = DB::select(" SELECT *,u.name as created_by,(case when created_by =". $created_by ." then 1 else 0 end) as allow_edit FROM screening_document_detail_checklists JOIN users ON users.id = screening_document_detail_checklists.created_by WHERE screening_document_checklist_id = ". $document_id ." AND screening_detail_id =". $screening_detail_id);

        /*$image = asset('storage/app/'.$data[0]->store_path);
        dd($image);*/
        return response()->json(['status' => 'success', 'message'=>'', 'data'=>$data]);
    }

    // delete attachment
    public function delete_attachment($id)
    {
        //
        $data = Screening_document_detail_checklist::find($id);// find record from member table
        $store_path = $data->store_path;
        $data->delete();
        
        // file delete from storage
        Storage::delete($store_path);
        
        return response()->json(['status' => 'success', 'message'=>'Attachment Deleted', 'data'=>$data]);
        //return redirect('/department_list');
    }


    //-------------- Email function from Employee after store employee ----------------
    //*********************************************************************************
    public function send_email_add_screening($screening)
    {
        //---fetch details of screening and employee info
        $screening_data = Screening_detail::with(
            [
                'designationsId',
                'lineManagerDesignationsId',
                'departmentsId',
                'regionId',
                'field_office',
                'onBehalfUserId',
                'scCreatedById',
                'scUpdatedById',
                'screeningStatusLogId',
                'screeningStatusLogId.createdById',
                'Employee_info.countries',
                'Employee_info.nationalityId',
                //'Employee_info.ethnicityId',
                'Employee_info.createdById',
                'Employee_info.updatedById',
            ])->find($screening);

        //$cc_emails = ['adil.shahzad@irp.org.pk', 'azeem.khan@irworldwide.org'];
        $details = [
            'title' => 'Mail from Global Screening Database',
            'subject'   => 'New Screening record has been include in GSD',
            'to'    => 'ahad.ahmed@irp.org.pk',
            //'cc'    => $cc_emails,
            'employee_name' => $screening_data->Employee_info->employee_name,
            'reference_no'  => $screening_data->reference_no,
            'nic'   => $screening_data->Employee_info->nic,
            'region'    => $screening_data->regionId->name,
            'field_office'    => $screening_data->field_office->name,

            'staff_type'    => $screening_data->type_of_staff,
            'designation'    => $screening_data->designationsId->name,
            'department'    => $screening_data->departmentsId->name,
            'line_manager'    => $screening_data->lineManagerDesignationsId->name,
            'status'    => 'Pending',
        ];

        //dd($details);

        //Mail::send(new SendMail($details));
        Mail::send('emails.email_add_screening', $details, function($message) use ($details) {
            $message->to($details['to']);
            //$message->cc($details['cc']);
            $message->subject($details['subject']);
            //$message->subject($details['message']);
        });

        //return redirect('screening_view/'.$screening);
    }



    public function send_bulk_email_add_screening($screening)
    {
        //---fetch details of screening and employee info
        /*$screening_data = Screening_detail::with(
            [
                'designationsId',
                'lineManagerDesignationsId',
                'departmentsId',
                'regionId',
                'field_office',
                'onBehalfUserId',
                'scCreatedById',
                'scUpdatedById',
                'screeningStatusLogId',
                'screeningStatusLogId.createdById',
                'Employee_info.countries',
                'Employee_info.nationalityId',
                //'Employee_info.ethnicityId',
                'Employee_info.createdById',
                'Employee_info.updatedById',
            ])->where('email_send',0)->get();*/
        //dd($screening_data);

        //$cc_emails = ['adil.shahzad@irp.org.pk', 'azeem.khan@irworldwide.org'];

        //--- get email address of those users who have region ALL access
        /*$all_region_users = User::select('email')
            ->where('region_id','0')
            ->where('screening_status_email','on')
            ->get();

        $final_field_office_email = array();// initialize an array - for final emails
        foreach ($all_region_users as $all_field)
        {
            // push element to one consolidate array
            array_push($final_field_office_email,$all_field->email);
        }*/

        //--- get email address of those users who have access of region which screening belong
        /*$specific_region_users = User::select('id','email', 'field_office_id')
            ->where('region_id', $screening_data->region_id)
            ->where('screening_status_email','on')
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
        }


        $details = [
            'title' => 'Mail from Global Screening Database',
            'subject'   => 'New Screening record has been include in GSD',
            'to'    => $final_field_office_email,
            //'cc'    => $cc_emails,
            'employee_name' => $screening_data->Employee_info->employee_name,
            'reference_no'  => $screening_data->reference_no,
            'nic'   => $screening_data->Employee_info->nic,
            'region'    => $screening_data->regionId->name,
            'field_office'    => $screening_data->field_office->name,

            'staff_type'    => $screening_data->type_of_staff,
            'designation'    => $screening_data->designationsId->name,
            'department'    => $screening_data->departmentsId->name,
            'line_manager'    => $screening_data->lineManagerDesignationsId->name,
            'status'    => 'Pending',
        ];*/

        //dd($details);

        //Mail::send(new SendMail($details));
        /*Mail::send('emails.email_add_screening', $details, function($message) use ($details) {
            $message->to($details['to']);
            //$message->cc($details['cc']);
            $message->subject($details['subject']);
            //$message->subject($details['message']);
        });*/

        //$job = (new SendQueueEmail($details))->delay(Carbon::now()->addSeconds(5));
        //dd($details);

        //dd($job);
        //dispatch($job);
        //dd($job);

        //return redirect('screening_view/'.$screening);


        $screening_data = Screening_detail::with(
            [
                'designationsId',
                'lineManagerDesignationsId',
                'departmentsId',
                'regionId',
                'field_office',
                'onBehalfUserId',
                'scCreatedById',
                'scUpdatedById',
                'screeningStatusLogId',
                'screeningStatusLogId.createdById',
                'Employee_info.countries',
                'Employee_info.nationalityId',
                //'Employee_info.ethnicityId',
                'Employee_info.createdById',
                'Employee_info.updatedById',
            ])->find($screening);


        //--- get email address of those users who have region ALL access
        /*$all_region_users = User::select('email')
            ->where('region_id','0')
            ->where('screening_add_email','on')
            ->get();*/

        $final_field_office_email = array();// initialize an array - for final emails
        /*foreach ($all_region_users as $all_field)
        {
            // push element to one consolidate array
            array_push($final_field_office_email,$all_field->email);
        }*/

        //--- get email address of those users who have access of region which screening belong
        $specific_region_users = User::select('id','email', 'region_id', 'field_office_id')
            ->where('screening_add_email','on')
            ->whereIn('region_id', array($screening_data->region_id, 0))
            //->orWhere('region_id','0')

            ->get();



        //---finding email of users those have the screening field office access
        foreach ($specific_region_users as $field)
        {
            if($field->region_id > 0)
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
                // push element to one consolidate array
                array_push($final_field_office_email,$field->email);
            }
        }

        $url = config('app.url');
        $details = [
            'title' => 'Mail from Global Screening Database',
            'subject'   => 'New Screening record has been include in GSD',
            'to'    => $final_field_office_email,
            //'cc'    => $cc_emails,
            'employee_name' => $screening_data->Employee_info->employee_name,
            'employee_surname' => $screening_data->Employee_info->employee_surname,
            'reference_no'  => $screening_data->reference_no,
            'nic'   => $screening_data->Employee_info->nic,
            'region'    => $screening_data->regionId->name,
            'field_office'    => $screening_data->field_office->name,

            'staff_type'    => $screening_data->type_of_staff,
            'designation'    => $screening_data->designationsId->name,
            'department'    => $screening_data->departmentsId->name,
            'line_manager'    => $screening_data->lineManagerDesignationsId->name,
            'status'    => 'Pending',
            'email_link'    =>$url.'/screening_view/'.$screening_data->id,
        ];

        $location = 'add';

        //Mail::send(new SendMail($details));
        /*Mail::send('emails.email_add_screening', $details, function($message) use ($details) {
            $message->to($details['to']);
            //$message->cc($details['cc']);
            $message->subject($details['subject']);
            //$message->subject($details['message']);
        });*/

        $job = (new SendQueueEmail($details, $location))->delay(now()->addMinutes(5));
        //dd($details);

        //dd($job);
        dispatch($job);

        DB::table('screening_details')
            ->where('id', $screening_data->id)
            ->update(['email_send' => "1"]);
    }

    //-------------- Email function on status change ----------------
    //*********************************************************************************
    public function send_email_screening_status_change($screening_detail_id)
    {
        //---fetch details of screening and employee info
        $screening_data = Screening_detail::with(
            [
                'designationsId',
                'lineManagerDesignationsId',
                'departmentsId',
                'regionId',
                'field_office',
                'onBehalfUserId',
                'scCreatedById',
                'scUpdatedById',
                'screeningStatusLogId',
                'screeningStatusLogId.createdById',
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
        //---who have region ALL access
        //---except the user who is performing activity
        $specific_region_users = User::select('id','email', 'region_id', 'field_office_id')
            ->where('screening_status_email','on')
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

        //dd($final_field_office_email);

        $url = config('app.url');
        $details = [
            'title' => 'Mail from Global Screening Database',
            'subject'   => 'Screening Result Declared',
            'to'    => $final_field_office_email,
            //'cc'    => 'adil.shahzad@irp.org.pk',
            //'cc'    => $cc_emails,
            'employee_name' => $screening_data->Employee_info->employee_name,
            'employee_surname' => $screening_data->Employee_info->employee_surname,
            'reference_no'  => $screening_data->reference_no,
            'nic'   => $screening_data->Employee_info->nic,
            'region'    => $screening_data->regionId->name,
            'field_office'    => $screening_data->field_office->name,

            'staff_type'    => $screening_data->type_of_staff,
            'designation'    => $screening_data->designationsId->name,
            'department'    => $screening_data->departmentsId->name,
            'line_manager'    => $screening_data->lineManagerDesignationsId->name,
            'status'    => 'Completed',
            'result'    => $screening_data->screening_result,
            'screening_date'    => $screening_data->screening_date,
            'created_by'    => Auth::user()->name,
            'email_link'    => $url.'/screening_view/'.$screening_data->id,
        ];

        //dd($details);

        /*$emailArray = ['details' =>$details,
            'location' => 'status'
        ];*/
        $location = 'status';

        $job = (new SendQueueEmail($details, $location))->delay(Carbon::now()->addSeconds(5));
        //dd($details);

        //dd($job);
        dispatch($job);

        //Mail::send(new SendMail($details));
        /*Mail::send('emails.email_screening_status', $details, function($message) use ($details) {
            $message->to($details['to']);
            $message->cc($details['cc']);
            $message->subject($details['subject']);
            //$message->subject($details['message']);
        });*/

        //return redirect('screening_view/'.$screening);
    }

    public function delete_screening(Request $request,$id)
    {
        
        // Delete attachments
        $attachment = Screening_document_detail_checklist::where('screening_detail_id',$id)->get();
        
        foreach ($attachment as $att)
        {
            $store_path = $att->store_path;

            // file delete from storage
            Storage::delete($store_path);
        }

        // Delete attachment record
        Screening_document_detail_checklist::where('screening_detail_id',$id)->delete();

        // Delete comments
        Screening_comment::where('screening_detail_id',$id)->delete();

        // Delete status log
        Screening_status_log::where('screening_detail_id',$id)->delete();

        // Delete screenign
        $screening = Screening_detail::find($id);// find record from member table
        $screening->delete();

        //-----Log entry
        $loggerArray = ['type' => 'alert', 'IP' => $request->ip(),
            'Message' =>'Screening - Delete Screening',
            'p_UserName' => Auth::user()->name,
            'Response' =>$screening
        ];

        $loggerHelper = new Helper_functions();
        $check = $loggerHelper->alertLogger($loggerArray);
        
        return response()->json(['status' => 'success', 'message'=>'Screening Deleted', 'data'=>$screening]);
        //return redirect('/department_list');
    }

}
