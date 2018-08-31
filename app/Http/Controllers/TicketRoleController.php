<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Kordy\Ticketit\Models\Agent;
use Kordy\Ticketit\Models\Company;
use Kordy\Ticketit\Models\Setting;
use Illuminate\Support\Facades\Session;
class TicketRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
        $roles = \App\User::hasRoles()->get();  
        return view('ticketit::admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = Agent::paginate(Setting::grab('paginate_items'));
        return view('ticketit::admin.roles.create', compact('users'));
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
        $agents_list = $this->addRole($request->input('agents'));
        $agents_names = implode(',', $agents_list);

        Session::flash('status', trans('ticketit::lang.roles-are-added-to-roles', ['names' => $agents_names]));

        return redirect()->action('TicketRoleController@index');
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
    public function edit($id)
    {
        //
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
        $this->syncUserCompanies($id, $request);

        Session::flash('status', trans('ticketit::lang.roles-joined-categories-ok'));

        return redirect()->action('TicketRoleController@index');
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
    }

    public function addRole($user_ids)
    {
        $users = User::find($user_ids);
        foreach ($users as $user) {
            $user->ticketit_role = true;
            $user->save();
            $users_list[] = $user->name;
        }

        return $users_list;
    }
    public function syncUserCompanies($id, Request $request)
    {
        $form_cats = ($request->input('company_cats') == null) ? [] : $request->input('company_cats');
        $user = User::find($id);
        $user->companies()->sync($form_cats);
    }
}
