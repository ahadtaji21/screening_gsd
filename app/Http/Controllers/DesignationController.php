<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Designation;
//use App\Models\User;


class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$data =  Designation::all()->getUserName;// table name is designation and model Designation

        //$user = User::all();
        $data = DB::select('select d.*, u.name as created from designations d
                              JOIN users u ON u.id = d.created_by
                              WHERE d.is_deleted = 0');
        return view('designation.index',['designation'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('designation.add_designation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_designation(Request $req)
    {
        //
        $req->validate([
            'name'=>'required',

        ]);

        $already_exist = Designation::where('name','=',$req->name)->first();
        if ($already_exist != null )// --- data found
        {
            return view('designation.add_designation')->with('Already Exist');
        }
        else
        {
            $dept = new Designation();
            $dept->name = $req->name;
            $dept->created_by = Auth::user()->id;
            $dept->created_at = date('Y-m-d');

            $dept->save();

            $data =  $req->name;
            //$data = $req->input('name');
            //$req->session()->flash('name',$data);
            return redirect('/designation_list')->with('Form has been saved for designation',$data);
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
    public function edit_designation($id)
    {
        //
        $data = Designation::find($id);// find record from member table
        return view('designation.edit_designation',["designation"=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_designation(Request $req, $id)
    {
        //
        $req->validate([
            'name'=>'required',

        ]);

        $data = Designation::find($id);
        $data->name = $req->name;
        $data->updated_at = date('Y-m-d');

        $data->save();
        return redirect('/designation_list')->with('Form has been saved for designation',$data);
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
        $data =  Designation::find($id);// find record from member table
        $data->is_deleted = '1';
        $data->updated_at = date('Y-m-d');
        $data->save();
        //$data->delete();
        //return redirect('/designation_list');
        return response()->json(['status' => 'Job Title Deleted successfully.']);
    }
}
