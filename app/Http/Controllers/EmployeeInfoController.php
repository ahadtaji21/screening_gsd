<?php

namespace App\Http\Controllers;

//use App\Mail\SendMail;
use App\Jobs\SendQueueEmail;
use App\Models\Employee_info;
use App\Models\Field_office;
use App\Models\Screening_detail;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;

use Helper_functions;

class EmployeeInfoController extends Controller
{
    public function index(Request $request)
    {
        //$uri = $request->fullUrl();
        //dd($uri);
        $screening_status = $request->screening_status;
        $type_of_staff = $request->type_of_staff;
        $region_clicked = $request->region_clicked;
        //dd($screening_status,$type_of_staff,$region_clicked);
        
        if ($screening_status == null && $type_of_staff == null && $region_clicked == null)
        {
            return view('employee_infos.index')->with(['screening_status' => '', 'type_of_staff' => '', 'region_clicked' => '']);
        }
        else
        {
            if ($screening_status != null)
            {
                return view('employee_infos.index')->with(['screening_status' => $screening_status, 'type_of_staff' => '' , 'region_clicked' => '']);
            }
            elseif ($type_of_staff != null)
            {
                return view('employee_infos.index')->with(['screening_status' => '','type_of_staff' => $type_of_staff, 'region_clicked' => '']);
            }
            elseif ($region_clicked != null)
            {
                return view('employee_infos.index')->with(['screening_status' => '', 'type_of_staff' => '', 'region_clicked' => $region_clicked]);
            }
        }        

    }

    public function search_employee(Request $request)
    {
        //dd(Carbon::now()->subDays(3)->toDateString());

        $department_id = null;
        $region_id = null;
        $field_office_id = null;
        $designation_id = null;
        $gender = null;
        $type_of_staff = null;
        $screening_result = null;
        $screening_status = null;
        $nic = null;
        $created_by = null;

        $contract_start_date = null;
        $contract_end_date = null;

        $screening_date_from = null;
        $screening_date_to = null;

        $created_at_from = null;
        $created_at_to = null;

        $user_region_id = null;
        $user_field_office_id = null;

        if (isset($request->department_id)) {
            $department_id = $request->department_id;
        }

        if (isset($request->region_id)) {
            $region_id = $request->region_id;
        }
        
        if (isset($request->field_office_id)) {
            $field_office_id = $request->field_office_id;
        }

        if (isset($request->designation_id)) {
            $designation_id = $request->designation_id;
        }

        if (isset($request->gender)) {
            $gender = $request->gender;
        }

        if (isset($request->type_of_staff)) {
            $type_of_staff = $request->type_of_staff;
        }

        if (isset($request->screening_result)) {
            $screening_result = $request->screening_result;
        }

        if (isset($request->screening_status)) {
            $screening_status = $request->screening_status;
        }


        if (isset($request->nic)) {
            $nic = $request->nic;
        }

        if (isset($request->created_by)) {
            $created_by = $request->created_by;
        }

        if (isset($request->contract_start_date) && isset($request->contract_start_date) != "") {
            $contract_start_date = date('Y-m-d', strtotime($request->contract_start_date));
            //dd('val'.$contract_start_date);
        }

        if (isset($request->contract_end_date) && isset($request->contract_end_date) != "") {
            $contract_end_date = date('Y-m-d', strtotime($request->contract_end_date));
        }

        if (isset($request->screening_date_from) && isset($request->screening_date_from) != "") {
            $screening_date_from = date('Y-m-d', strtotime($request->screening_date_from));
        }
        if (isset($request->screening_date_to) && isset($request->screening_date_to) != "") {
            $screening_date_to = date('Y-m-d', strtotime($request->screening_date_to));
        }

        if (isset($request->created_at_from) && isset($request->created_at_from) != "") {
            $created_at_from = date('Y-m-d', strtotime($request->created_at_from));
        }
        if (isset($request->created_at_to) && isset($request->created_at_to) != "") {
            $created_at_to = date('Y-m-d', strtotime($request->created_at_to));
        }

        if (isset($request->user_region_id)) {
            $user_region_id = $request->user_region_id;
        }

        if (isset($request->user_field_office_id)) {
            $user_field_office_id = $request->user_field_office_id;
        }

        //$new_user_field_office_id = explode(',',$user_field_office_id);

        //$new_user_field_office_id = json_decode($user_field_office_id, true);
        //
        //
        //
        if ($field_office_id == "null")
        {
            $field_office_id = null;
        }

        if ($user_field_office_id != null)
        {
            $new_user_field_office_id = explode(',',$user_field_office_id);
        }
        else
        {
            $new_user_field_office_id = null;
        }

        //dd($new_user_field_office_id);


        $query = DB::table("employee_infos AS e")
                        ->select(DB::raw("e.id as employee_info_id,
                                        sd.reference_no,
                                        e.employee_name,
                                        IFNULL(e.employee_surname,'') AS employee_surname,
                                       
                                        e.gender,
                                        CASE
                                            WHEN (e.nic IS NULL OR e.nic = '') THEN e.passport
                                            WHEN (e.passport IS NULL OR e.passport) THEN e.nic
                                            ELSE e.nic
                                        END AS nic,
                                        DATE_FORMAT(e.dob,'%d-%b-%Y') AS dob,
                                        e.email AS email,
                                        f.name AS field_office,
                                        r.name AS region,
                                        IFNULL(d.name,'N/A') AS department,
                                        IFNULL(dg.name,'N/A') AS designation,
                                        IFNULL(sd.type_of_staff,'N/A') AS type_of_staff,
                                        IFNULL(sd.employee_status,'N/A') AS employee_status,
                                        IFNULL(sd.screening_status,'') AS screening_status,
                                        IFNULL(sd.screening_result,'N/A') AS screening_result,
                                        IFNULL(DATE_FORMAT(sd.screening_date,'%d-%b-%Y'),'N/A') AS screening_date,
                                        
                                        u.name AS created_by,
                                        DATE_FORMAT(e.created_at,'%d-%b-%Y') AS created_at,
                                        DATE_FORMAT(sd.created_at,'%d-%b-%Y') AS screening_created_at,
                                        DATEDIFF(CURDATE(),sd.created_at) AS days")
                        )

                        ->join('users AS u', 'u.id', '=', 'e.created_by')
                        ->leftjoin('screening_details AS sd', function($join)
                            {
                                $join->on('sd.employee_info_id', '=', 'e.id')
                                    ->where('sd.record_status', '=', 1);
                            })
                        ->leftjoin('departments AS d', 'd.id', '=', 'sd.department_id')
                        ->leftjoin('designations AS dg', 'dg.id', '=', 'sd.designation_id')
                        ->leftjoin('regions AS r', 'r.id', '=', 'sd.region_id')
                        ->leftjoin('field_offices AS f', 'f.id', '=', 'sd.field_office_id')

                        ->when($department_id, function ($query, $department_id)
                            {
                                return $query->where('sd.department_id', $department_id);
                            })
                        ->when($region_id, function ($query, $region_id)
                             {
                                return $query->where('sd.region_id', $region_id);
                            })
                        ->when($user_region_id, function ($query, $user_region_id)
                        {
                            return $query->where('sd.region_id', $user_region_id);
                        })
                        ->when($field_office_id, function ($query, $field_office_id)
                            {
                                return $query->where('sd.field_office_id', $field_office_id);
                            })
                        ->when($new_user_field_office_id, function ($query, $new_user_field_office_id)
                            {
                                return $query->whereIn('sd.field_office_id', $new_user_field_office_id);
                            })
                        ->when($designation_id, function ($query, $designation_id)
                            {
                                return $query->where('sd.designation_id', $designation_id);
                            })
                        ->when($gender, function ($query, $gender)
                            {
                                return $query->where('e.gender', $gender);
                            })

                        ->when($type_of_staff, function ($query, $type_of_staff)
                            {
                                return $query->where('sd.type_of_staff', $type_of_staff);
                            })

                        ->when($screening_result, function ($query, $screening_result)
                            {
                                return $query->where('sd.screening_result', $screening_result);
                            })
                        ->when($screening_status, function ($query, $screening_status)
                            {
                                return $query->where('sd.screening_status', $screening_status);
                            })
                        ->when($nic, function ($query, $nic)
                            {
                                return $query
                                    //->whereIn('e.field_office_id',$new_user_field_office_id)
                                    ->where(function($query) use ($nic){
                                        $query->where('e.nic', 'like', '%' . $nic . '%');
                                        $query->orWhere('e.employee_name', 'like', '%' . $nic . '%');
                                        $query->orWhere('e.employee_surname', 'like', '%' . $nic . '%');
                                        $query->orWhere('e.passport', 'like', '%' . $nic . '%');
                                        $query->orWhere('e.reference_no', 'like', '%' . $nic . '%');
                                    });
                                    //->Where('e.nic', 'like', '%' . $nic . '%')
                                    //->orWhere('e.employee_name', 'like', '%' . $nic . '%')
                                    //->orWhere('e.passport', 'like', '%' . $nic . '%')
                                    //->orWhere('e.reference_no', 'like', '%' . $nic . '%');
                            })
                        ->when($created_by, function ($query, $created_by)
                            {
                                return $query->where('e.created_by', $created_by);
                            })
                        ->when($contract_start_date, function ($query, $contract_start_date)
                            {
                                return $query->where('sd.contract_start_date', '>=', $contract_start_date);
                            })
                        ->when($contract_end_date, function ($query, $contract_end_date)
                            {
                                return $query->where('sd.contract_end_date', '<=', $contract_end_date);
                            })
                        ->when($screening_date_from, function ($query, $screening_date_from)
                            {
                                return $query->where('sd.screening_date', '>=', $screening_date_from);
                            })
                        ->when($screening_date_to, function ($query, $screening_date_to)
                            {
                                return $query->where('sd.screening_date', '<=', $screening_date_to);
                            })
                        ->when($created_at_from, function ($query, $created_at_from)
                            {
                                return $query->where('e.created_at', '>=', $created_at_from);
                            })
                        ->when($created_at_to, function ($query, $created_at_to)
                            {
                                return $query->where('e.created_at', '<=', $created_at_to);
                            })
                        ->orderBy('sd.screening_status')
                        //->orderBy('e.employee_name')
                        //->orderByDesc('sd.id')
                        ->orderByDesc('days');


        //dd($query->toSql());
        //exit;
        $query= $query->get();

        return Datatables::of($query)->make(true);
        //return response()->json(["status" => "success", "message" => "", "data" => $data]);

    }

    public function missing_employee_screening_list(Request $request)
    {
        return view('employee_infos.missing_screening_employee_info');

    }

    public function search_missing_employee(Request $request)
    {
        $gender = null;
        $screening_status = null;
        $nic = null;
        $created_at_from = null;
        $created_at_to = null;
        $created_by = null;
        
        if (isset($request->gender)) {
            $gender = $request->gender;
        }
        
        if (isset($request->screening_status)) {
            $screening_status = $request->screening_status;
        }
        
        if (isset($request->nic)) {
            $nic = $request->nic;
        }

        if (isset($request->created_by)) {
            $created_by = $request->created_by;
        }
        
        if (isset($request->created_at_from) && isset($request->created_at_from) != "") {
            $created_at_from = date('Y-m-d', strtotime($request->created_at_from));
        }
        if (isset($request->created_at_to) && isset($request->created_at_to) != "") {
            $created_at_to = date('Y-m-d', strtotime($request->created_at_to));
        }
        

        $query = DB::table("employee_infos AS e")
            ->select(DB::raw("e.id as employee_info_id,
                                        e.employee_name,
                                        IFNULL(e.employee_surname,'') as employee_surname,
                                        e.gender,
                                        CASE
                                            WHEN (e.nic IS NULL OR e.nic = '') THEN e.passport
                                            WHEN (e.passport IS NULL OR e.passport) THEN e.nic
                                            ELSE e.nic
                                        END AS nic,
                                        DATE_FORMAT(e.dob,'%d-%b-%Y') AS dob,
                                        e.email AS email,
                                        
                                        c.name as nationality,
                                        e.ethnicity,
                                        u.name AS created_by,
                                        DATE_FORMAT(e.created_at,'%d-%b-%Y') AS created_at")
            )

            ->join('users AS u', 'u.id', '=', 'e.created_by')
            ->join('countries AS c', 'c.id', '=', 'e.nationality')
            //->join('screening_details AS sd', 'sd.employee_info_id', '!=', 'e.id')
            /*->leftjoin('screening_details AS sd', function($join)
            {
                $join->on('sd.employee_info_id', '!=', 'e.id')
                    ->where('sd.record_status', '=', 1);
            })*/

            ->when($gender, function ($query, $gender)
            {
                return $query->where('e.gender', $gender);
            })

            ->when($screening_status, function ($query, $screening_status)
            {
                return $query->where('sd.screening_status', $screening_status);
            })
            ->when($nic, function ($query, $nic)
            {
                return $query
                    //->whereIn('e.field_office_id',$new_user_field_office_id)
                    ->where(function($query) use ($nic){
                        $query->where('e.nic', 'like', '%' . $nic . '%');
                        $query->orWhere('e.employee_name', 'like', '%' . $nic . '%');
                        $query->orWhere('e.employee_surname', 'like', '%' . $nic . '%');
                        $query->orWhere('e.passport', 'like', '%' . $nic . '%');
                        $query->orWhere('e.reference_no', 'like', '%' . $nic . '%');
                    });
                //->Where('e.nic', 'like', '%' . $nic . '%')
                //->orWhere('e.employee_name', 'like', '%' . $nic . '%')
                //->orWhere('e.passport', 'like', '%' . $nic . '%')
                //->orWhere('e.reference_no', 'like', '%' . $nic . '%');
            })

            ->when($created_at_from, function ($query, $created_at_from)
            {
                return $query->where('e.created_at', '>=', $created_at_from);
            })
            ->when($created_at_to, function ($query, $created_at_to)
            {
                return $query->where('e.created_at', '<=', $created_at_to);
            })
            ->whereNotIn('e.id', function ($query)
            {
                $query->select('employee_info_id')
                    ->from(with(new Screening_detail())->getTable());
            })
            ->where('e.created_by', $created_by)
            ->orderByDesc('e.created_at');

        //dd($query->toSql());
        //exit;
        $query= $query->get();

        return Datatables::of($query)->make(true);
        //return response()->json(["status" => "success", "message" => "", "data" => $data]);

    }



    public function add_employee_info()
    {
        $countries = DB::table('countries')->select('id','name')->get();
        //$regions = DB::table('regions')->select('id','name')->get();
        return view('employee_infos.add_employee_info')
        ->with(['countries'=>$countries]);
    }

    public function insert_employee_info(Request $request)
    {
        $validated = $request->validate([
            'employee_name'         => 'required|regex:/^[\pL\s\-]+$/u',
            'employee_surname'      => 'required|regex:/^[\pL\s\-]+$/u',
            'father_name'           => 'required|regex:/^[\pL\s\-]+$/u',
            'father_surname'        => 'required|regex:/^[\pL\s\-]+$/u',
            'dob'                   => 'required',
            'country_of_birth'      => 'required',
            /*'region_id'             => 'required',
            'field_office_id'       => 'required',*/
            'address'               => 'required',
            'email'                 => 'required|string|email|max:255',
            'gender'                => 'required',
            'nic'                   => 'required|required_without:passport',
            'nationality'           => 'required',
            'ethnicity'             => 'required',
        ]);


        $employee_name = ucwords(strtolower($request->employee_name));
        $employee_surname = ucwords(strtolower($request->employee_surname));
        $father_name = ucwords(strtolower($request->father_name));
        $father_surname = ucwords(strtolower($request->father_surname));
        $ethnicity = ucwords(strtolower($request->ethnicity));
        
        if (isset($request->dob))
        {
            $dob = date('Y-m-d', strtotime($request->dob));
        }
        else
        {
            $dob = null;
        }


        if (isset($request->passport))
        {
            $passport = ($request->passport);
        }
        else
        {
            $passport = '';
        }

        if (isset($request->nic))
        {
            $nic = ($request->nic);
        }
        else
        {
            $nic = '';
        }

        //******************* Check record if exists **********************************
        if (Employee_info::where('nic', '=', $nic)->exists()) {
            // employee found
            flash('Sorry, Employee already exists with provided NIC!. Try another employee')->error();

            $loggerArray = ['type' => 'warning', 'IP' => $request->ip(),
                'Message' =>'EmployeeInfo - New employee(NIC) record already exists',
                'p_UserName' => Auth::user()->name,
                'Response' =>$request->all(),
            ];

            $loggerHelper = new Helper_functions();
            $check = $loggerHelper->insertLogger($loggerArray);

            return back()->withInput()->withErrors(['nic' => ['NIC Exists']]);
        }

        if (Employee_info::where('passport', '=', $passport)
                            ->where('passport','!=', '')
                            ->exists())
        {
            // employee found
            flash('Sorry, Employee already exists with provided Passport!. Try another employee')->error();

            return back()->withInput()->withErrors(['passport' => ['Passort Exists']]);
        }

        if (Employee_info::where('email', '=', ($request->email))->exists())
        {
            // employee found
            flash('Sorry, Employee already exists with provided Email!. Try another employee')->error();

            $loggerArray = ['type' => 'warning', 'IP' => $request->ip(),
                'Message' =>'EmployeeInfo - New employee(email) record already exists',
                'p_UserName' => Auth::user()->name,
                'Response' =>$request->all(),
            ];

            $loggerHelper = new Helper_functions();
            $check = $loggerHelper->insertLogger($loggerArray);
            //return redirect()->back();
            return back()->withInput()->withErrors(['email' => ['Email Exists']]);
        }

        //------ Get short name of field office - Reference no --------------
        /*$field_office_id = $request->field_office_id;
        $acronym = Field_office::find($field_office_id);*/

        //--------------------------------------------------------------------

        //*******************************************************************************
        //---- Insert into Employee Info table
        $emp = new Employee_info;
        $emp->employee_name = $employee_name;
        $emp->employee_surname = $employee_surname;
        $emp->father_name = $father_name;
        $emp->father_surname = $father_surname;
        $emp->dob = $dob;
        $emp->country_of_birth = $request->country_of_birth;
        /*$emp->region_id = $request->region_id;
        $emp->field_office_id = $request->field_office_id;*/
        $emp->address = $request->address;
        $emp->email = $request->email;
        $emp->gender = $request->gender;
        $emp->passport = $passport;
        $emp->nic = $nic;
        $emp->nationality = $request->nationality;
        $emp->ethnicity = $ethnicity;
        $emp->created_by = Auth::user()->id;
        $emp->created_at = Carbon::now();

        $emp->save();
        $employee_info_id = $emp->id; // last insert ID

        $loggerArray = ['type' => 'info', 'IP' => $request->ip(),
            'Message' =>'EmployeeInfo - New employee record inserted',
            'p_UserName' => Auth::user()->name,
            'Response' =>$emp,
        ];

        $loggerHelper = new Helper_functions();
        $check = $loggerHelper->insertLogger($loggerArray);


        //********** Generated reference num ***********************************
        //----- update reference no against last insert ID
        /*$reference_no = '';
        $ref = Employee_info::find($employee_info_id);
        $reference_no = $acronym->acronym.$employee_info_id;

        $ref->reference_no = $reference_no;
        $ref->save();*/
        //**********************************************************************


        //return redirect('/employee_list')->with('Form has been saved for employee',$employee_name);
        //return $this->send_email_employee($employee_name, $reference_no);

        return redirect('/screening_add/'.$employee_info_id);
    }

    public function edit_employee_info($employee_id)
    {
        //dd($request->data-id);
        ///$employee_id = $request->id;
        $user_region = Auth::user()->region_id;
        $user_field_offices = Auth::user()->field_office_id;
        $new_user_field_offices = explode(',',$user_field_offices);
        //dd($user_field_offices);

        $employee = DB::table('employee_infos')->where('id',$employee_id)->first();
        $countries = DB::table('countries')->select('id','name')->get();
        /*if ($user_region == 0)
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
        }*/
        //$field_offices = DB::table('field_offices')->select('id','name', 'acronym')->whereIn('id',$user_field_offices)->get();
        return view('employee_infos.edit_employee_info')
        ->with(['employee'=>$employee, 'countries'=>$countries]);
    }

    public function update_employee_info(Request $request, $employee_id)
    {
        $validated = $request->validate([
            'employee_name'         => 'required',
            'employee_surname'      => 'required',
            'father_name'           => 'required',
            'father_surname'        => 'required',
            'dob'                   => 'required',
            'country_of_birth'      => 'required',
            //'region_id'             => 'required',
            //'field_office_id'       => 'required',
            'address'               => 'required',
            'email'                 => 'required|string|email|max:255',
            'gender'                => 'required',
            'nic'                   => 'required|required_without:passport',
            'nationality'           => 'required',
            'ethnicity'             => 'required',
        ]);

        $employee_name = ucwords(strtolower($request->employee_name));
        $employee_surname = ucwords(strtolower($request->employee_surname));
        $father_name = ucwords(strtolower($request->father_name));
        $father_surname = ucwords(strtolower($request->father_surname));
        $ethnicity = ucwords(strtolower($request->ethnicity));
        
        /*$old_field_office_id = $request->old_field_office_id;
        $field_office_id = $request->field_office_id;


        if ($field_office_id == null)
        {
            $field_office_id = $old_field_office_id;
        }


        if ($old_field_office_id != $field_office_id)
        {
            $acronym = Field_office::find($field_office_id);
            //dd($acronym->acronym,$employee_id);
            $reference_no = $acronym->acronym.$employee_id;
        }
        else
        {
            $reference_no = $request->reference_no;
        }*/

        if (isset($request->dob))
        {
            $dob = date('Y-m-d', strtotime($request->dob));
        }
        else
        {
            $dob = null;
        }


        if (isset($request->passport))
        {
            $passport = ($request->passport);
        }
        else
        {
            $passport = '';
        }

        if (isset($request->nic))
        {
            $nic = ($request->nic);
        }
        else
        {
            $nic = '';
        }



        //******************* Check record if exists **********************************
        if (Employee_info::where('id','!=',$employee_id)
                ->where('nic', '=', $nic)
                ->exists())
        {
            // employee found
            flash('Sorry, Employee already exists with provided NIC!. Try another employee')->error();

            $loggerArray = ['type' => 'warning', 'IP' => $request->ip(),
                'Message' =>'EmployeeInfo - Edited employee(NIC) record already exists',
                'p_UserName' => Auth::user()->name,
                'Response' =>$request->all(),
            ];

            $loggerHelper = new Helper_functions();
            $check = $loggerHelper->insertLogger($loggerArray);

            return back()->withInput()->withErrors(['nic' => ['NIC Exists']]);
        }



        if ($passport != "" && $passport != 'N/A' && $passport != 'Nil')
        {
            if (Employee_info::where('id','!=',$employee_id)
                ->where('passport','=', $passport)
                ->exists())
            {
                // employee found
                flash('Sorry, Employee already exists with provided Passport!. Try another employee')->error();

                return back()->withInput()->withErrors(['passport' => ['Passport Exists']]);
            }

        }

        if (Employee_info::where('id','!=',$employee_id)
            ->where('email', '=', ($request->email))
            ->exists())
        {
            // employee found
            flash('Sorry, Employee already exists with provided Email!. Try another employee')->error();

            $loggerArray = ['type' => 'warning', 'IP' => $request->ip(),
                'Message' =>'EmployeeInfo - Edited employee(email) record already exists',
                'p_UserName' => Auth::user()->name,
                'Response' =>$request->all(),
            ];

            $loggerHelper = new Helper_functions();
            $check = $loggerHelper->insertLogger($loggerArray);
            //return redirect()->back();
            return back()->withInput()->withErrors(['email' => ['Email Exists']]);
        }


        /*$data = array(
            // 'user_id'        => $request->user_id,
            'reference_no'      => $reference_no,
            // 'employee_id'   => $request->employee_id,	
            'employee_name'     => $employee_name,
            'father_name'       => $father_name,
            'dob'               => $dob,
            'country_of_birth'  => $request->country_of_birth,
            'region_id'         => $request->region_id,
            'field_office_id'   => $field_office_id,
            'address'           => $request->address,
            'email'             => $request->email,
            'gender'            => $request->gender,
            'passport'          => $passport,
            'nic'               => $nic,
            'nationality'       => $request->nationality,
            'ethnicity'         => $ethnicity,
            'updated_by'        => Auth::user()->id,
            'updated_at'        => Carbon::now(),
            );

        DB::table('employee_infos')
            ->where('id', $employee_id)
            ->update($data);*/

        $emp = Employee_info::find($employee_id);
        //$emp->reference_no = $reference_no;
        $emp->employee_name = $employee_name;
        $emp->employee_surname = $employee_surname;
        $emp->father_name = $father_name;
        $emp->father_surname = $father_surname;
        $emp->dob = $dob;
        $emp->country_of_birth = $request->country_of_birth;
        /*$emp->region_id = $request->region_id;
        $emp->field_office_id = $request->field_office_id;*/
        $emp->address = $request->address;
        $emp->email = $request->email;
        $emp->gender = $request->gender;
        $emp->passport = $passport;
        $emp->nic = $nic;
        $emp->nationality = $request->nationality;
        $emp->ethnicity = $ethnicity;
        $emp->updated_by = Auth::user()->id;
        $emp->updated_at = Carbon::now();

        $old_record = $emp->getOriginal();// get old records
        $change_data = array_diff($old_record,$emp->toarray());

        $emp->save();

        $updated_fields = $emp->getChanges();// get edited fields

        $loggerArray = ['type' => 'info', 'IP' => $request->ip(),
            'Message' =>'EmployeeInfo - Employee record updated',
            'p_UserName' => Auth::user()->name,
            'Response' =>$emp,
            'UpdatedData' => $updated_fields,
            'OldData' => $change_data
        ];

        $loggerHelper = new Helper_functions();
        $check = $loggerHelper->editLogger($loggerArray);

        flash('Employee record has been updated')->success();
        return redirect('/employee_list')->with('Record has been updated for employee',$employee_name);
    }


    public function view_details_employee($id)
    {
        $employees = Employee_info::with(
            [
                'countries',
                'nationalityId',
                //'ethnicityId',
                'createdById',
                'updatedById',
                'screening.regionId',
                'screening.field_office',
                'screening.designationsId',
                'screening.lineManagerDesignationsId',
                'screening.departmentsId',
                'screening.scCreatedById',
                'screening.scUpdatedById',
                'screening.onBehalfUserId'
            ])->find($id);

        if(is_null($employees))
        {
            flash('Sorry, employee does not exist!')->error();
            return redirect('/employee_list');
        }

        //dd($employees);

        $employees_array = $employees['screening'];
        $plucked = $employees_array->pluck('screening_status');
        $statuses = $plucked->all();
        $add_screening = true;
        if(in_array(1, $statuses))
        {
            $add_screening = false;
        }
        
        
        return view('employee_infos.view_details_employee')
            ->with([
                'employees'=>$employees,
                'add_screening' => $add_screening
            ]);
    }


    // --- update Leaver status marking - MODAL
    //************************************************
    public function update_modal_leaver(Request $req)
    {
        //dd($req->all());
        // initial form saved
        $req->validate([
            'screening_detail_id'=>'required',
            'employee_info_id'=>'required',
            'employee_status_dated'=>'required',
            'comment'=>'required',
        ]);
        //dd($req->all());
        $screening_detail_id = $req->screening_detail_id;
        $employee_info_id = $req->employee_info_id;
        $employee_status_dated = $req->employee_status_dated;
        $desc = $req->comment;

        $modalUpdate = Screening_detail::find($screening_detail_id);


        //$user = new User;
        $modalUpdate->employee_status = '2';//---mark Leaver
        $modalUpdate->employee_status_dated = $employee_status_dated;
        $modalUpdate->leaver_comment = $desc;
        $modalUpdate->updated_by = Auth::user()->id;
        $modalUpdate->updated_at = date('Y-m-d');

        $old_record = $modalUpdate->getOriginal();// get old records
        $change_data = array_diff_assoc($old_record,$modalUpdate->toarray());

        $modalUpdate->save();
        $updated_fields = $modalUpdate->getChanges();// get edited fields

        //-----Log entry
        $loggerArray = ['type' => 'info', 'IP' => $req->ip(),
            'Message' =>'EmployeeInfo - Leaver record update from employee view details',
            'p_UserName' => Auth::user()->name,
            'Response' =>$modalUpdate,
            'UpdatedData' => $updated_fields,
            'OldData' => $change_data
        ];

        $loggerHelper = new Helper_functions();
        $check = $loggerHelper->editLogger($loggerArray);


        //---- sent email on leaver marking --- //
        $this->send_email_leaver_marking($screening_detail_id);

        return redirect("employee_view/{$employee_info_id}")->with('Leaver has been marked',$modalUpdate);
    }

    //-------------- Email function on status change ----------------
    //*********************************************************************************
    public function send_email_leaver_marking($screening_detail_id)
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
        
        $final_field_office_email = array();// initialize an array - for final emails
        
        //--- get email address of those users who have access of region which screening belong
        //---who have region ALL access
        //---except the user who is performing activity
        $specific_region_users = User::select('id','email', 'region_id', 'field_office_id')
            ->where('employee_leaver_email','on')
            ->whereIn('region_id', array($screening_data->region_id, 0))
            ->where('id', '!=', Auth::user()->id)

            ->get();
        

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
            'subject'   => 'Employee Mark as Leaver',
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
            'status'    => 'Leaver',
            'employee_status_date'    => $screening_data->employee_status_dated,
            //'screening_date'    => $screening_data->screening_date,
            'created_by'    => Auth::user()->name,
            'email_link'    => $url.'/employee_view/'.$screening_data->Employee_info->id,
        ];

        //dd($details);

        /*$emailArray = ['details' =>$details,
            'location' => 'status'
        ];*/
        $location = 'leaver';

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

    
}
