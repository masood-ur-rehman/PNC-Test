<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Update;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Http\Requests\Company\Store;
class CompaniesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
        $companies =  Companies::orderBy('id','desc')->paginate(10);

        return view('admin.company.index')->with([
            'page_title'=> 'Companies List',
            'companies'=> $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.company.add')
        ->with([
            'page_title'=> 'Add New Company',
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
        $company  = Companies::findOrFail($id);
        return view('admin.company.add')->with([
            'page_title' => 'Company Edit Form',
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Company\Update $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        return $request->process($id);
    }

    public function destroy($id){
        $company  = Companies::findOrFail($id)->delete();
        return redirect()->route('admin::company.index')->with('success', 'ID# '.$id.' Company successfully deleted.');
    }
}
