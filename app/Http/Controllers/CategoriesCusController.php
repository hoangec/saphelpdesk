<?php

namespace App\Http\Controllers;

use App\CategoryAdv;
use Illuminate\Http\Request;
use Kordy\Ticketit\Controllers\CategoriesController;
use Illuminate\Support\Facades\Session;
class CategoriesCusController extends CategoriesController
{
    //
    public function index()
    {
        $categories = \Cache::remember('ticketit::categories', 60, function () {
            return CategoryAdv::all();
        });

        return view('ticketit::admin.category.index', compact('categories'));
    }
    public function edit($id)
    {
        $category = CategoryAdv::findOrFail($id);
        return view('ticketit::admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'color'     => 'required',
            'code'		=> 'required',           
        ]);

        $category = CategoryAdv::findOrFail($id);
        $category->update([
        		'name' => $request->name,
        		'color' => $request->color,
        		'code' => $request->code,
        		'parameters' => $request->parameters
        	]);

        Session::flash('status', trans('ticketit::lang.category-name-has-been-modified', ['name' => $request->name]));

        \Cache::forget('ticketit::categories');

        return redirect()->action('CategoriesCusController@index');
    }
    public function store(Request $request)
    {    	
        $this->validate($request, [
            'name'      => 'required',
            'color'     => 'required',
            'code'		=> 'required',            
        ]);

        $category = new CategoryAdv();
        $category->create([
        	'name' => $request->name,
        	'color' => $request->color,
        	'code' => $request->code,
        	'parameters' => $request->parameters]);

        Session::flash('status', trans('ticketit::lang.category-name-has-been-created', ['name' => $request->name]));

        \Cache::forget('ticketit::categories');

        return redirect()->action('CategoriesCusController@index');
    }
}
