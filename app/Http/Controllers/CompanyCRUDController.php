<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyCRUDController extends Controller
{
    //Create index
    public function index(){
        $data['companies'] = Company::orderBy('id','asc')->paginate(5);
        return view('companies.index', $data);
    }

    //Create resource
    public function create(){
        return view('companies.create');
    }

    //store resource
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company has been created successfuly!');
    }

    public function edit(Company $company){
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'address'=> 'required'
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company has been updated successfully.');
    }

    //delete
    public function destroy(Company $company){
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully.');
    }   
}
