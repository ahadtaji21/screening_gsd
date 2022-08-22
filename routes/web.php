<?php


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\FieldOfficeController;
use App\Http\Controllers\AjaxFillDropDown;
use App\Http\Controllers\EmployeeInfoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

//------------------------------- Roles Definition ----------------
define('Administrator', 1);
define('Operator', 2);
define('Viewer', 3);
define ('SuperAdmin', 4);
//-----------------------------------------------------------------

Route::get('/', function () {
    return view('auth.login');
});

/*Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth'])->name('dashboard');*/

//----------- Dashboard ------------------------------------------

Route::get('/dashboard',array(
        'uses'=>'App\Http\Controllers\DashboardController@index',
        'as' =>'dashboard',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);


//---drill down links
Route::get('/employee_list_pending',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_pending',
        'as' =>'employee_list_pending',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_completed',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_completed',
        'as' =>'employee_list_completed',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_Employee',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_employee',
        'as' =>'employee_list_Employee',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_Part-time',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_parttime',
        'as' =>'employee_list_Part-time',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);


Route::get('/employee_list_Consultant',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_consultant',
        'as' =>'employee_list_Consultant',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_Short Term',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_shortterm',
        'as' =>'employee_list_Short Term',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_Intern',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_intern',
        'as' =>'employee_list_Intern',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_Volunteer',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_volunteer',
        'as' =>'employee_list_Volunteer',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);


//----charts
Route::get('/get_status_month_chart',array(
        'uses'=>'App\Http\Controllers\DashboardController@getMonthlyScreeningStatusData',
        'as' =>'get_status_month_chart',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);
Route::get('/get_employee_status_month_chart',array(
        'uses'=>'App\Http\Controllers\DashboardController@getMonthlyEmployeeStatusData',
        'as' =>'get_employee_status_month_chart',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/get_eastafrica_status_month_chart',array(
        'uses'=>'App\Http\Controllers\DashboardController@getMonthlyEastAfricaStatusData',
        'as' =>'get_eastafrica_status_month_chart',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/get_westafrica_status_month_chart',array(
        'uses'=>'App\Http\Controllers\DashboardController@getMonthlyWestAfricaStatusData',
        'as' =>'get_westafrica_status_month_chart',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/get_asia_status_month_chart',array(
        'uses'=>'App\Http\Controllers\DashboardController@getMonthlyAsiaStatusData',
        'as' =>'get_asia_status_month_chart',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/get_menaee_status_month_chart',array(
        'uses'=>'App\Http\Controllers\DashboardController@getMonthlyMenaeeStatusData',
        'as' =>'get_menaee_status_month_chart',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

/*Route::get('/screening_list', function () {
    return view('screening.index');
})->middleware(['auth'])->name('screening_list');*/

/*Route::get('/logout', function () {
    if (session()->has(Auth::user()->name))
    {
        //session_destroy();
        session()->pull(Auth::user()->name,null);
    }
    return view('auth.login');
});*/

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


//----------------------------- User Routes ------------------------------------------------------------

//---*** Laravel 8 syntax style but sending and string because did not find any way to send extra array
/*Route::get('user_list',[UserController::class, 'index'])
    ->middleware(['auth','roles', 'roles:1:2'])
    ->name('user_list');*/


Route::get('/user_list',array(
        'uses'=>'App\Http\Controllers\UserController@index',
        'as' =>'user_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
        )
    );


Route::get('/email_user_list',array(
        'uses'=>'App\Http\Controllers\UserController@email_user_list',
        'as' =>'email_user_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::get('/login_log_report',array(
        'uses'=>'App\Http\Controllers\UserController@login_log_report',
        'as' =>'login_log_report',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);



Route::get('/show_user_list',array(
        'uses'=>'App\Http\Controllers\UserController@show_user_list',
        'as' =>'show_user_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
        )
    );

// open form
Route::get('/user_add',array(
        'uses'=>'App\Http\Controllers\UserController@add_user',
        'as' =>'user_add',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

//save form
Route::post('/store_user',array(
        'uses'=>'App\Http\Controllers\UserController@store_user',
        'as' =>'user_add',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::get('/user_edit/{id}',array(
        'uses'=>'App\Http\Controllers\UserController@edit_user',
        'as' =>'user_edit',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::post('/update_user/{id}',array(
        'uses'=>'App\Http\Controllers\UserController@update_user',
        'as' =>'update_user',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::get('/delete_user/{id}',array(
        'uses'=>'App\Http\Controllers\UserController@delete_user',
        'as' =>'delete_user',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin]
    )
);

Route::get('change_password',[UserController::class, 'change_password'])
    ->middleware(['auth'])
    ->name('change_password');// open form
Route::post('store_change_password',[UserController::class, 'store_change_password'])
    ->middleware(['auth'])
    ->name('store_change_password');// save form




/*Route::get('show_user_list',[UserController::class, 'show_user_list'])
    ->middleware(['auth'])
    ->name('show_user_list');
Route::get('user_add',[UserController::class, 'add_user'])->middleware(['auth'])->name('user_add');// open form
Route::post('store_user',[UserController::class, 'store_user'])->middleware(['auth'])->name('store_user');// save form
Route::get('user_edit/{id}',[UserController::class, 'edit_user'])->middleware(['auth'])->name('user_edit');
Route::post('update_user/{id}',[UserController::class, 'update_user'])->middleware(['auth'])->name('update_user');
Route::get('delete_user/{id}',[UserController::class, 'delete_user'])->middleware(['auth'])->name('delete_user');*/


//------------------------ Department Routes ----------------------------------------------------------------
Route::get('/department_list',array(
        'uses'=>'App\Http\Controllers\DepartmentController@index',
        'as' =>'department_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);
//open form
Route::get('/add_dept',array(
        'uses'=>'App\Http\Controllers\DepartmentController@create',
        'as' =>'add_dept',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::post('/store_dept',array(
        'uses'=>'App\Http\Controllers\DepartmentController@store_dept',
        'as' =>'store_dept',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::get('/edit_dept/{id}',array(
        'uses'=>'App\Http\Controllers\DepartmentController@edit_dept',
        'as' =>'edit_dept',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::post('/update_dept/{id}',array(
        'uses'=>'App\Http\Controllers\DepartmentController@update_dept',
        'as' =>'update_dept',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::get('/delete_dept/{id}',array(
        'uses'=>'App\Http\Controllers\DepartmentController@destroy',
        'as' =>'delete_dept',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin]
    )
);
/*Route::get('department_list',[DepartmentController::class, 'index'])->middleware(['auth'])->name('department_list');
Route::get('add_dept',[DepartmentController::class, 'create'])->middleware(['auth'])->name('add_dept');// open form
Route::post('store_dept',[DepartmentController::class, 'store_dept'])->middleware(['auth'])->name('store_dept');// save form
Route::get('edit_dept/{id}',[DepartmentController::class, 'edit_dept'])->middleware(['auth'])->name('edit_dept');
Route::post('update_dept/{id}',[DepartmentController::class, 'update_dept'])->middleware(['auth'])->name('update_dept');
Route::get('delete_dept/{id}',[DepartmentController::class, 'destroy'])->middleware(['auth'])->name('delete_dept');*/

//----------------------------------- Designation Routes ------------------------------------------------
Route::get('/designation_list',array(
        'uses'=>'App\Http\Controllers\DesignationController@index',
        'as' =>'designation_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);
//open form
Route::get('/add_designation',array(
        'uses'=>'App\Http\Controllers\DesignationController@create',
        'as' =>'add_designation',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::post('/store_designation',array(
        'uses'=>'App\Http\Controllers\DesignationController@store_designation',
        'as' =>'store_designation',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::get('/edit_designation/{id}',array(
        'uses'=>'App\Http\Controllers\DesignationController@edit_designation',
        'as' =>'edit_designation',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::post('/update_designation/{id}',array(
        'uses'=>'App\Http\Controllers\DesignationController@update_designation',
        'as' =>'update_designation',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

Route::get('/delete_designation/{id}',array(
        'uses'=>'App\Http\Controllers\DesignationController@destroy',
        'as' =>'delete_designation',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin]
    )
);
/*Route::get('designation_list',[DesignationController::class, 'index'])->middleware(['auth'])->name('designation_list');
Route::get('add_designation',[DesignationController::class, 'create'])->middleware(['auth'])->name('add_designation');// open form
Route::post('store_designation',[DesignationController::class, 'store_designation'])->middleware(['auth'])->name('store_designation');// save form
Route::get('edit_designation/{id}',[DesignationController::class, 'edit_designation'])->middleware(['auth'])->name('edit_designation');
Route::post('update_designation/{id}',[DesignationController::class, 'update_designation'])->middleware(['auth'])->name('update_designation');
Route::get('delete_designation/{id}',[DesignationController::class, 'destroy'])->middleware(['auth'])->name('delete_designation');*/


//------ Field offices Routes -------------
Route::get('/field_offices',array(
        'uses'=>'App\Http\Controllers\FieldOfficeController@index',
        'as' =>'field_offices',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);


Route::get('/region_list',array(
        'uses'=>'App\Http\Controllers\RegionController@index',
        'as' =>'region_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);
//----------------------------- Employee routes ------------------------------------------------------------
Route::get('/employee_list',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@index',
        'as' =>'employee_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/search_employee',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@search_employee',
        'as' =>'search_employee',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/missing_employee_list',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@missing_employee_screening_list',
        'as' =>'missing_employee_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/search_missing_employee',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@search_missing_employee',
        'as' =>'search_missing_employee',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_info_add',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@add_employee_info',
        'as' =>'employee_info_add',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::post('/employee_info_insert',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@insert_employee_info',
        'as' =>'employee_info_insert',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::get('/employee_info_edit/{employee_id}',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@edit_employee_info',
        'as' =>'employee_info_edit',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::post('employee_info_update/{employee_id}',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@update_employee_info',
        'as' =>'employee_info_update',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::get('/employee_view/{id}',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@view_details_employee',
        'as' =>'employee_view',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

//--------------------------------- modal leaver status ----------------------------------------------
Route::post('/update_modal_leaver',array(
        'uses'=>'App\Http\Controllers\EmployeeInfoController@update_modal_leaver',
        'as' =>'update_modal_leaver',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

//*********************************** Screening Routes **********************************
Route::get('/screening_add/{employee_info_id}',array(
        'uses'=>'App\Http\Controllers\ScreeningController@add_screening_2',
        'as' =>'screening_add',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::post('/screening_insert/{employee_info_id}',array(
        'uses'=>'App\Http\Controllers\ScreeningController@insert_screening_2',
        'as' =>'screening_insert',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::get('/screening_edit/{employee_info_id}/{screening_id}',array(
        'uses'=>'App\Http\Controllers\ScreeningController@edit_screening_2',
        'as' =>'screening_edit',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::post('/screening_update/{screening_id}',array(
        'uses'=>'App\Http\Controllers\ScreeningController@update_screening_2',
        'as' =>'screening_update',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);


Route::get('/screening_view/{id}',array(
        'uses'=>'App\Http\Controllers\ScreeningController@view_details_screening',
        'as' =>'screening_view',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);


//---------------------------------- modal In-progress status -------------------------------------------
Route::post('/update_modal_inprogress',array(
        'uses'=>'App\Http\Controllers\ScreeningController@update_modal_inprogress',
        'as' =>'update_modal_inprogress',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);
//--------------------------------- modal completed status ----------------------------------------------
Route::post('/update_modal_completed',array(
        'uses'=>'App\Http\Controllers\ScreeningController@update_modal_completed',
        'as' =>'update_modal_completed',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator]
    )
);

//************************************ Attachments Routes *************************************************
//attach nic
Route::post('/save_attachment_nic',array(
        'uses'=>'App\Http\Controllers\ScreeningController@save_attachment_nic',
        'as' =>'save_attachment_nic',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);


//attach resume
Route::post('/save_attachment_resume',array(
        'uses'=>'App\Http\Controllers\ScreeningController@save_attachment_resume',
        'as' =>'save_attachment_resume',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

//attach experience
Route::post('/save_attachment_experience',array(
        'uses'=>'App\Http\Controllers\ScreeningController@save_attachment_experience',
        'as' =>'save_attachment_experience',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

//attach qualification
Route::post('/save_attachment_qualification',array(
        'uses'=>'App\Http\Controllers\ScreeningController@save_attachment_qualification',
        'as' =>'save_attachment_qualification',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

//attach police
Route::post('/save_attachment_police',array(
        'uses'=>'App\Http\Controllers\ScreeningController@save_attachment_police',
        'as' =>'save_attachment_police',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

//attach other
Route::post('/save_attachment_other',array(
        'uses'=>'App\Http\Controllers\ScreeningController@save_attachment_other',
        'as' =>'save_attachment_other',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

//--- Fill attachment routes
//attach nic, parameter send via data attribute of ajax
/*Route::get('/find_attachment_nic',array(
        'uses'=>'App\Http\Controllers\ScreeningController@find_attachment_nic',
        'as' =>'find_attachment_nic',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);*/
// NO USE ABOVE ROUTE AS IT WAS HANDLED IN LARAVEL CORE FUNCTIONALITY -------------------------------------

//--- Delete attachments
Route::get('/delete_attachment/{id}',array(
        'uses'=>'App\Http\Controllers\ScreeningController@delete_attachment',
        'as' =>'delete_attachment',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

//Route::get('screening_list',[ScreeningController::class, 'index'])->middleware(['auth'])->name('screening_list');
//Route::get('screening_add',[ScreeningController::class, 'add_screening'])->middleware(['auth'])->name('screening_add');
//Route::get('screening_view',[ScreeningController::class, 'insert_screening'])->middleware(['auth'])->name('screening_view');
//Route::get('screening_edit',[ScreeningController::class, 'edit_screening'])->middleware(['auth'])->name('screening_edit');
//Route::get('screening_view',[ScreeningController::class, 'view_details_screening'])->middleware(['auth'])->name('screening_view');

//-------------------------- AJAX Drop Down ---------------------------------------
Route::get('fillCountryDropDown',[AjaxFillDropDown::class, 'fillCountryDropDown'])->middleware(['auth'])->name('fillCountryDropDown');
Route::get('fillNationalityDropDown',[AjaxFillDropDown::class, 'fillNationalityDropDown'])->middleware(['auth'])->name('fillNationalityDropDown');
Route::get('fillEthnicityDropDown',[AjaxFillDropDown::class, 'fillEthnicityDropDown'])->middleware(['auth'])->name('fillEthnicityDropDown');
Route::get('fillDepartmentDropDown',[AjaxFillDropDown::class, 'fillDepartmentDropDown'])->middleware(['auth'])->name('fillDepartmentDropDown');
Route::get('fillDesignationDropDown',[AjaxFillDropDown::class, 'fillDesignationDropDown'])->middleware(['auth'])->name('fillDesignationDropDown');
Route::get('fillUserDropDown',[AjaxFillDropDown::class, 'fillUserDropDown'])->middleware(['auth'])->name('fillUserDropDown');

Route::get('/fillFieldOfficeByRegionDropDown',[AjaxFillDropDown::class, 'fillFieldOfficeByRegionDropDown'])
    ->middleware(['auth'])->name('fillFieldOfficeByRegionDropDown');

Route::get('/fillUserFieldOfficeDropDown',[AjaxFillDropDown::class, 'fillUserFieldOfficeDropDown'])
    ->middleware(['auth'])->name('fillUserFieldOfficeDropDown');

Route::get('/find_screening_comments',[AjaxFillDropDown::class, 'find_screening_comments'])
    ->middleware(['auth'])->name('find_screening_comments');

Route::post('/save_screening_comments',array(
        'uses'=>'App\Http\Controllers\AjaxFillDropDown@save_screening_comments',
        'as' =>'save_screening_comments',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::get('/delete_screening_comments',array(
        'uses'=>'App\Http\Controllers\AjaxFillDropDown@delete_screening_comments',
        'as' =>'delete_screening_comments',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::get('/send_email_insert_comment',array(
        'uses'=>'App\Http\Controllers\AjaxFillDropDown@send_email_insert_comment',
        'as' =>'send_email_insert_comment',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator]
    )
);

Route::get('/queue_list',array(
        'uses'=>'App\Http\Controllers\QueJobController@index',
        'as' =>'queue_list',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin]
    )
);

Route::get('/employee_list_east_africa',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_east_africa',
        'as' =>'employee_list_east_africa',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_west_africa',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_west_africa',
        'as' =>'employee_list_west_africa',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_asia',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_asia',
        'as' =>'employee_list_asia',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);

Route::get('/employee_list_menaee',array(
        'uses'=>'App\Http\Controllers\DashboardController@employee_list_menaee',
        'as' =>'employee_list_menaee',
        'middleware' => ['auth','roles'],
        'roles' => [SuperAdmin, Administrator, Operator, Viewer]
    )
);


Route::get('/delete_screening/{id}',array(
    'uses'=>'App\Http\Controllers\ScreeningController@delete_screening',
    'as' =>'delete_screening',
    'middleware' => ['auth','roles'],
    'roles' => [SuperAdmin, Administrator]
)
);