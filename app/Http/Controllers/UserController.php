<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\Region;
use App\Models\User;
use App\Models\Field_office;
use App\Models\Department;
use App\Models\Designation;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use App\Rules\MatchOldPassword;
use Helper_functions;


//use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::with(
            [
                'designationId',
                'departmentId',
                'regionID',
                //'fieldOfficeIds',

            ])->get();

        $office_names = DB::table('field_offices')->pluck('name','id')->toArray();

        foreach ($user as $key => $office)
        {
            $collect_field_office = explode(',',$office->field_office_id);
            //$office_name = DB::table('field_offices')->whereIN('id',$collect_field_office)->pluck('name')->toArray();
            $office_name = array_intersect_key($office_names, array_flip($collect_field_office));
            $user[$key]['office_name'] = implode(',',$office_name);
        }

        return view('user.index')
            ->with([
                'users'=>$user,
                'field_office_name' => $office_name
            ]);
        
    }

    public function email_user_list()
    {

        $user = User::with(
            [
                'designationId',
                'departmentId',
                'regionID',
                //'fieldOfficeIds',

            ])->get();

        $office_names = DB::table('field_offices')->pluck('name','id')->toArray();

        //$queryOffice_names = DB::table('field_offices')->select('id','name')->get()->toArray();
        foreach ($user as $key => $office)
        {
            $collect_field_office = explode(',',$office->field_office_id);
            //$office_name = DB::table('field_offices')->whereIN('id',$collect_field_office)->pluck('name')->toArray();
            $office_name = array_intersect_key($office_names, array_flip($collect_field_office));
            $user[$key]['office_name'] = implode(',',$office_name);
        }



        //return view('user.index',['users'=>$user]);
        return view('user.email_mgt')
            ->with([
                'users'=>$user,
                'field_office_name' => $office_name
            ]);

    }
    
    
    public function show_user_list()
    {
        //$data - Member_m::all();
        //$data =  User::all();// table name is users and model User
        $data = DB::select('select u.*, 
                              f.name as field_office,
                              d.name as department,
                              dg.name as designation
                              from users u
                              JOIN field_offices f ON f.id = u.field_office_id
                              JOIN departments d ON d.id = u.department_id
                              JOIN desginations dg ON dg.id = u.designation_id
                              WHERE u.is_deleted = 0
                              ORDER BY u.created_at DESC');
        
        //return view('user.index',['users'=>$data]);
        //return view('user.index');
        return response()->json(array('success' => true, 'message'=>'', 'data'=>$data));

    }

    public function add_user()
    {
        $regions = Region::all();
        //$field_offices = Field_office::all();
        $departments = Department::all();
        $designations = Designation::all();
        return view('user.add_user', [
                                        'regions'=>$regions,
                                        //'field_offices'=>$field_offices,
                                        'designations'=>$designations,
                                        'departments'=>$departments
        ]);
    }

    public function store_user(Request $req)
    {
        // initial form saved
        $req->validate([
            'name'=>'required|regex:/^[\pL\s\-]+$/u',
            'gender'=>'required',
            'password' => ['required', 'min:6', Rules\Password::defaults()],
            'email'=>'required|string|email|max:255|unique:users',
            'department_id'=>'required',
            'designation_id'=>'required',
            'region_id'=>'required',
            //'field_office_id'=>'required',
            'user_role_id'=>'required',
            'status'=>'required',
            /*'screening_add_email'=>'required',
            'screening_status_email'=>'required',
            'screening_email_email'=>'required',*/
        ]);
        //dd($req->all());
        
        $name = ucwords(strtolower($req->name));

        if (($req->region_id != 0) && ($req->field_office_id == '' || $req->field_office_id == null))
        {
            flash('Field office filed is mandatory in-case of specified region')->error();
            return back()->withInput()->withErrors(['field_office_id' => ['Field Office required']]);
        }

        $field_office_ids = $req->field_office_id;
        if ($field_office_ids == '' || $field_office_ids == null)
        {
            $collection_field_office_id = '';
        }
        else
        {
            $collection_field_office_id = implode(',',$field_office_ids);
        }

        if ($req->screening_add_email == '' || $req->screening_add_email == 'off')
        {
            $screening_add_email = 'off';
        }
        else
        {
            $screening_add_email = $req->screening_add_email;
        }

        if ($req->screening_status_email == '' || $req->screening_status_email == 'off')
        {
            $screening_status_email = 'off';
        }
        else
        {
            $screening_status_email = $req->screening_status_email;
        }

        if ($req->screening_comment_email == '' || $req->screening_comment_email == 'off')
        {
            $screening_comment_email = 'off';
        }
        else
        {
            $screening_comment_email = $req->screening_comment_email;
        }

        if ($req->employee_leaver_email == '' || $req->employee_leaver_email == 'off')
        {
            $employee_leaver_email = 'off';
        }
        else
        {
            $employee_leaver_email = $req->employee_leaver_email;
        }
        

        if (User::where('email', '=', ($req->email))->exists())
        {
            // employee found
            flash('Sorry, User already exists with provided Email!. Try another employee')->error();

            $loggerArray = ['type' => 'warning', 'IP' => $req->ip(),
                'Message' =>'User - New user(email) record already exists',
                'p_UserName' => Auth::user()->name,
                'Response' =>$req->all(),
            ];

            $loggerHelper = new Helper_functions();
            $check = $loggerHelper->insertLogger($loggerArray);
            //return redirect()->back();
            return back()->withInput()->withErrors(['email' => ['Email Exists']]);
        }

        //--------------------------- MonoLog ---------------------------------------//
        //***************************************************************************//

        //---------- create a log channel
        //$dateFormat = "Y n j, g:i a";
        //----------- the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        //$output = "%level_name% > %message%  %context% \n";

        //----------- finally, create a formatter
        /*$formatter = new LineFormatter($output, $dateFormat);
        $stream = new StreamHandler(__DIR__.'/../../../storage/logs/Screening/AllLogs.log', Logger::INFO);
        $firephp = new FirePHPHandler();
        $stream->setFormatter($formatter);*/

        //------- Create the main logger of the app
        /*$logger = new Logger('user_add');
        $logger->pushHandler($stream);
        $logger->pushHandler($firephp);*/

        //---- Usage in queries
        /*$logger->info('login user :',array('p_UserName' => Auth::user()->name,
            'IP Address'=> $req->ip(),
            'DateTime'=> date('Y-m-d H:i:s'),
            'Response'=>$user));*/

        //--------------------------- MonoLog ---------------------------------------//
        //***************************************************************************//

        
        $user = new User;
        $user->name = $name;
        $user->gender = $req->gender;
        $user->password = Hash::make($req->password);
        $user->email = $req->email;
        $user->department_id = $req->department_id;
        $user->designation_id = $req->designation_id;
        $user->region_id = $req->region_id;
        $user->field_office_id = $collection_field_office_id;
        $user->user_role_id = $req->user_role_id;
        $user->status = $req->status;
        $user->created_by = Auth::user()->id;
        $user->screening_add_email = $screening_add_email;
        $user->screening_status_email = $screening_status_email;
        $user->screening_comment_email = $screening_comment_email;
        $user->employee_leaver_email = $employee_leaver_email;
        //$user->created_at = date('Y-m-d');
        $user->save();

        $data =  $req->name;
        //$data = $req->input('name');
        //$req->session()->flash('name',$data);

        $loggerArray = ['type' => 'info', 'IP' => $req->ip(),
            'Message' =>'Users - New user record inserted',
            'p_UserName' => Auth::user()->name,
            'Response' =>$user,
        ];
        
        $loggerHelper = new Helper_functions();
        $check = $loggerHelper->insertLogger($loggerArray);
        
        return redirect('/user_list')->with('Form has been saved for',$data);
        //return view('user.index');
    }

    /*public function insertLogger($loggerArray)
    {
        //dd($loggerArray['Updated_fields']);
        if ($loggerArray['type'] == 'info')
        {
            Log::info('User update by user :',array
                (
                    'p_UserName' => $loggerArray['p_UserName'],
                    'IP Address'=> $loggerArray['IP'],
                    'DateTime'=> date('Y-m-d H:i:s'),
                    'Response'=>$loggerArray['Response'],
                    'Updated_fields'=>$loggerArray['Updated_fields'],
                )
            );
        }
    }*/

    public function edit_user($id)
    {
        $regions = Region::all();
        //$field_office_id = Field_office::all();
        $departments = Department::all();
        $designations = Designation::all();
        $data = User::find($id);

        $collect_field_office = explode(',',$data->field_office_id);
        $office_name = DB::table('field_offices')->where('region_id',$data->region_id)->get()->toArray();


        //$office_name_data = array_flip($office_name);
        $data['office_id'] = $collect_field_office;
        $data['office_name'] = $office_name;

        //dd($data);


        return view('user.edit_user', ['regions'=>$regions,
                                        'field_office_id'=>$office_name,
                                        //'office_name_data'=>$office_name_data,
                                        'designations'=>$designations,
                                        'departments'=>$departments,
                                        'user'=>$data]);

    }

    public function update_user(Request $req, $id)
    {
        //
        $req->validate([
            'name'=>'required',
            'gender'=>'required',
            'email'=>'bail|required|string|email|max:255',
            'department_id'=>'required',
            'designation_id'=>'required',
            'region_id'=>'required',
            //'field_office_id'=>'required',
            'user_role_id'=>'required',
            'status'=>'required',
        ]);
        //dd($req->has('screening_comment_email'));

        $user = User::find($id);
        $name = ucwords(strtolower($req->name));

        if (($req->region_id != 0) && ($req->field_office_id == '' || $req->field_office_id == null))
        {
            flash('Field office filed is mandatory in-case of specified region')->error();
            return back()->withInput()->withErrors(['field_office_id' => ['Field Office required']]);
        }

        $field_office_ids = $req->field_office_id;
        if ($field_office_ids == '' || $field_office_ids == null)
        {
            $collection_field_office_id = '';
        }
        else
        {
            $collection_field_office_id = implode(',',$field_office_ids);
        }


        if ($req->screening_add_email == '' || $req->screening_add_email == 'off')
        {
            $screening_add_email = 'off';
        }
        else
        {
            $screening_add_email = $req->screening_add_email;
        }

        if ($req->screening_status_email == '' || $req->screening_status_email == 'off')
        {
            $screening_status_email = 'off';
        }
        else
        {
            $screening_status_email = $req->screening_status_email;
        }

        if ($req->screening_comment_email == '' || $req->screening_comment_email == 'off')
        {
            $screening_comment_email = 'off';
        }
        else
        {
            $screening_comment_email = $req->screening_comment_email;
        }

        if ($req->employee_leaver_email == '' || $req->employee_leaver_email == 'off')
        {
            $employee_leaver_email = 'off';
        }
        else
        {
            $employee_leaver_email = $req->employee_leaver_email;
        }
        

        if (User::where('id','!=',$id)
                    ->where('email', '=', ($req->email))
                    ->exists())
        {
            // employee found
            flash('Sorry, User already exists with provided Email!. Try another employee')->error();

            $loggerArray = ['type' => 'warning', 'IP' => $req->ip(),
                'Message' =>'User - New user(email) record already exists',
                'p_UserName' => Auth::user()->name,
                'Response' =>$req->all(),
            ];

            $loggerHelper = new Helper_functions();
            $check = $loggerHelper->insertLogger($loggerArray);
            //return redirect()->back();
            return back()->withInput()->withErrors(['email' => ['Email Exists']]);
        }


        //$user = new User;
        $user->name = $name;
        $user->gender = $req->gender;
        $user->email = $req->email;
        $user->department_id = $req->department_id;
        $user->designation_id = $req->designation_id;
        $user->region_id = $req->region_id;
        $user->field_office_id = $collection_field_office_id;
        $user->user_role_id = $req->user_role_id;
        $user->status = $req->status;
        $user->updated_at = date('Y-m-d');
        $user->screening_add_email = $screening_add_email;
        $user->screening_status_email = $screening_status_email;
        $user->screening_comment_email = $screening_comment_email;
        $user->employee_leaver_email = $employee_leaver_email;

        $old_record = $user->getOriginal();// get old records
        $change_data = array_diff($old_record,$user->toarray());
        

        $user->save();
        
        $updated_fields = $user->getChanges();// get edited fields
        //dd($user);

        $loggerArray = ['type' => 'info', 'IP' => $req->ip(),
            'Message' =>'Users - User record updated',
            'p_UserName' => Auth::user()->name,
            'Response' =>$user,
            'UpdatedData' => $updated_fields,
            'OldData' => $change_data
        ];


        //$this->insertLogger($loggerArray);
        $loggerHelper = new Helper_functions();
        $check = $loggerHelper->editLogger($loggerArray);
        //dd($check);

        /*Log::info('User updated by user :',array('p_UserName' => Auth::user()->name,
            'IP Address'=> $req->ip(),
            'DateTime'=> date('Y-m-d H:i:s'),
            'Response'=>$user));*/


        return redirect('/user_list')->with('Form has been updated',$user);
    }



    public function delete_user($id)
    {
        //
        $data =  User::find($id);// find record from user table
        $data->is_deleted = '1';
        $data->updated_at = date('Y-m-d');
        $data->save();
        //return redirect('/user_list')->with('User has been marked as deleted');
        return response()->json(['status' => 'User Deleted successfully.']);
    }

    //----------------------------- Change Password Section ------------------------------------------
    //************************************************************************************************
    public function change_password()
    {
        return view('user.change_password');
    }

    public function store_change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:6', Rules\Password::defaults()],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        flash('Password change successfully.')->success();
        return redirect('/change_password');
        
    }
    //----------------------------- End Change Password -----------------------------------------------


    //-----------------------------Login Log report ---------------------------------------------------
    public function login_log_report()
    {

        $login_log_report = LoginLog::orderBy('id', 'desc')->get();


        $report = DB::select(DB::raw("SELECT
                                          COUNT(distinct T.user_id) unique_visitor,
                                          T.yearMonth,
                                          COUNT(T.user_id) successfull_login
                                        FROM
                                          (SELECT user_id,DATE_FORMAT(created_at,'%Y-%b') as yearMonth FROM login_logs WHERE login_status = 'true'
                                          ) T
                                        GROUP BY
                                          T.yearMonth
                                        ORDER BY
                                        T.yearMonth DESC"));
        return view('user.login_log_report',['login_log_report'=>$login_log_report, 'reports'=>$report]);
        
    }
}