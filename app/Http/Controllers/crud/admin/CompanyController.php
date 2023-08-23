<?php

namespace App\Http\Controllers\crud\admin\companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = DB::select("SELECT `id`, `name`, `address` FROM `companies`");
        return view('crud.admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crud.admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::insert("INSERT INTO `companies` (`name`, `address`) VALUES ('" . $request->name . "', '" . $request->address . "') ");

        $companies = DB::select("SELECT `id`, `name`, `address` FROM `companies`");
        return view('crud.admin.companies.index', compact('companies'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
