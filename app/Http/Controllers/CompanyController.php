<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = \Cache::remember('companies', 60, function () {
            return Company::all();
        });        
        return view('ticketit::admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('ticketit::admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name'      => 'required',
            'company_code'     => 'required',
        ]);        
        $company = new Company();
        $company->create(['name' => $request->name, 'company_code' => $request->company_code]);

        Session::flash('status', trans('ticketit::lang.company-name-has-been-created', ['name' => $request->name]));

        \Cache::forget('companies');

        return redirect()->action('CompanyController@index');
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
        return trans('ticketit::lang.company-all-tickets-here');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $company = Company::findOrFail($id);

        return view('ticketit::admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name'      => 'required',
            'company_code'     => 'required',
        ]);

        $company = Company::findOrFail($id);
        $company->update(['name' => $request->name, 'company_code' => $request->company_code]);

        Session::flash('status', trans('ticketit::lang.company-name-has-been-modified', ['name' => $request->name]));

        \Cache::forget('companies');

        return redirect()->action('CompanyController@index');
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
        $company = Company::findOrFail($id);
        $name = $company->name;        
        $company->delete();

        Session::flash('status', trans('ticketit::lang.company-name-has-been-deleted', ['name' => $name]));

        \Cache::forget('companies');

        return redirect()->action('CompanyController@index');
    }
}
