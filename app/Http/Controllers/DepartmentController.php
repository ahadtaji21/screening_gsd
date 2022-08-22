<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$data =  Department::all();// table name is users and model User
        //$data = DB::select('select * from users');
        $data = DB::select('select d.*, u.name as created from departments d
                              JOIN users u ON u.id = d.created_by
                              WHERE d.is_deleted = 0');
        return view('department.index',['department'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('department.add_dept');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_dept(Request $req)
    {
        //
        $req->validate([
            'name'=>'required',
            
        ]);

        $already_exist = Department::where('name','=',$req->name)->first();
        if ($already_exist != null )// --- data found
        {
            return view('department.add_dept')->with('Already Exist');
        }
        else
        {
            $dept = new Department();
            $dept->name = $req->name;
            $dept->created_by = Auth::user()->id;
            $dept->created_at = date('Y-m-d');

            $dept->save();

            $data =  $req->name;
            //$data = $req->input('name');
            //$req->session()->flash('name',$data);
            return redirect('/department_list')->with('Form has been saved for department',$data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_dept($id)
    {
        //
        $data = Department::find($id);// find record from member table
        return view('department.edit_dept',["dept"=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_dept(Request $req, $id)
    {
        //
        $req->validate([
            'name'=>'required',

        ]);

        $data = Department::find($id);
        $data->name = $req->name;
        $data->updated_at = date('Y-m-d');

        $data->save();
        return redirect('/department_list')->with('Form has been saved for department',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        //$id = $request->id;
        $data = NULL;
        $data = Department::find($id);// find record from member table
        $data->is_deleted = '1';
        $data->updated_at = date('Y-m-d');
        $data->save();
        //$data->delete();



        return response()->json(['status' => 'Department Deleted successfully.']);
        //return redirect('/department_list');
    }
}
