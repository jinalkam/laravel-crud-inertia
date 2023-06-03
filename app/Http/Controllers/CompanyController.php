<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $companies = Company::latest()->get();
        return Inertia::render('Companies/Index',  [
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Companies/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'established_date' => 'required|date',
            'confirmed' => 'required',
        ]);

        Company::create([
            'name' => $request->name,
            'established_date' => $request->established_date,
            'confirmed' => $request->confirmed
        ]);
        sleep(1);

        $request->session()->flash('success', 'Company Added Successfully');
        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {   
        
        return Inertia::render(
            'Companies/Edit',
            [
                'company' => $company
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'established_date' => 'required|date',
            'confirmed' => 'required',
        ]);

        $company->name = $request->name;
        $company->established_date = $request->established_date;
        $company->confirmed = $request->confirmed;
        $company->save();
        sleep(1);
        $request->session()->flash('success', 'Company Updated Successfully');
        return redirect()->route('companies.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Company $company)
    {
        
        $company->delete();
        sleep(1);
        $request->session()->flash('success', 'Company Deleted Successfully');
        return redirect()->route('companies.index');
    }
}
