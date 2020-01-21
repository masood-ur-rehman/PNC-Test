<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Update;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\Store;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
        $employees =  Employees::orderBy('id','desc')->with('Company')->paginate(10);

        return view('admin.employee.index')->with([
            'page_title'=> 'Employee List',
            'employees'=> $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $companies = \App\Models\Companies::get();

        return view('admin.employee.add')
        ->with([
            'page_title'=> 'Add New Employee',
            'companies'=> $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        return $request->process();
    }   


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee  = Employees::findOrFail($id);
        $companies = \App\Models\Companies::get();
        return view('admin.employee.add')->with([
            'page_title' => 'Employee Edit Form',
            'employee' => $employee,
            'companies'=> $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Employee\Update $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        return $request->process($id);
    }

    public function destroy($id){
        $employee  = Employees::findOrFail($id)->delete();
        return redirect()->route('admin::employee.index')->with('success', 'ID# '.$id.' Employee successfully deleted.');
    }
}
