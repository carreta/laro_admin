<?php

namespace App\Http\Controllers\crud\admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{

    public function __construct()
    {
        $this->document_types = DB::select("SELECT `id`, `name` FROM `document_types`");
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $document_types = $this->document_types;
        return view('crud.admin.document_types.index', $document_types);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crud.admin.document_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::insert("INSERT INTO `document_types` (`name`, `hacienda_id`) VALUES ('" . $request->name . "', '" . $request->hacienda_id . "') ");
        return view('crud.admin.document_types.index', compact('document_types'));
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
        $document_types = DB::select("SELECT `id`, `name`, `hacienda_id` FROM `document_types` WHERE `id` = '" . $id . "' ");
        return view('crud.admin.document_types.edit', compact('document_types', 'id'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::update("UPDATE `document_types` SET `hacienda_id` = '" . $request->hacienda_id . "', `name` = '" . $request->name . "' WHERE `id` = '" . $id . "' ");

        return view('crud.admin.document_types.index', compact('document_types'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::delete("DELETE FROM `document_types` WHERE `id` = '" . $id . "' ");
        return view('crud.admin.document_types.index', compact('document_types'));
    }
}
