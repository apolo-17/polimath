<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
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
        return $this->sendResponse($company = Company::paginate(10), 'Complete!!!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logo_companies');
            $data['logo'] = '/storage/' . $path;
        }

        $company = Company::create($data);
        return $this->sendResponse($company, 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return $this->sendResponse($company, 'Show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company, Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logo_companies');
            $data['logo'] = '/storage/' . $path;
        } else {
            unset($data['logo']);
        }

        $company->update($data);

        return $this->sendResponse($company, 'Updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return $this->sendResponse('Deleted !!');
    }
}
