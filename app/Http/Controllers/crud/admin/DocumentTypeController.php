<?php

namespace App\Http\Controllers\crud\admin;

use App\Http\Controllers\Controller;
use App\Models\crud\admin\DocumentType;
use App\Models\ViewField;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class DocumentTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:crud.admin.document_types.index')->only('index');
        $this->middleware('can:crud.admin.document_types.create')->only('create', 'store');
        $this->middleware('can:crud.admin.document_types.edit')->only('edit', 'update');
        $this->middleware('can:crud.admin.document_types.destroy')->only('destroy');
        $this->collection = DocumentType::select('hacienda_id', 'name')->paginate(15);
        $this->view_fields = ViewField::select('route', 'field_names', 'table_names', 'view_name')->where('route', 'document_types')->get();
        $this->permissions = Permission::select('name')->where('name', 'LIKE', "%crud.admin.document_types%")->OrderBy('id', 'ASC')->get();
        $this->controller = 'App\Http\Controllers\crud\admin\DocumentTypeController';
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection = $this->collection;
        $view_fields = $this->view_fields[0];
        $controller = $this->controller;
        $permissions = $this->permissions;
        
        $array = $view_fields->field_names;
        $field_names = explode(",", $array);

        $array = $view_fields->table_names;
        $table_names = explode(",", $array);

        // dd($permissions[0] . ' - ' . $permissions[1] . ' - ' . $permissions[3] . ' - ' . $permissions[5]);
        return view('crud.admin.document_types.index', compact('collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names'));
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

        $collection = $this->collection;
        $view_fields = $this->view_fields[0];
        $controller = $this->controller;
        $permissions = $this->permissions;
        
        $array = $view_fields->field_names;
        $field_names = explode(",", $array);

        $array = $view_fields->table_names;
        $table_names = explode(",", $array);

        DB::insert("INSERT INTO `document_types` (`name`, `hacienda_id`) VALUES ('" . $request->name . "', '" . $request->hacienda_id . "') ");
        return redirect('document_types')->with('status', 'saved', 'collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names');
        // return view('crud.admin.document_types.index', compact('document_types', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names'))->withSuccess('LALA');
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
        $view_fields = $this->view_fields[0];

        try {
            // $document_types = DB::select("SELECT `hacienda_id`, `name` FROM `document_types` WHERE `hacienda_id` = '" . $id . "' ");            
            $document_types = DocumentType::select('hacienda_id', 'name')->where('hacienda_id', $id)->get();
            return view('crud.admin.document_types.edit', compact('document_types', 'id', 'view_fields'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::update("UPDATE `document_types` SET `name` = '" . $request->name . "' WHERE `hacienda_id` = '" . $id . "' ");
        return redirect('document_types')->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collection = $this->collection;
        $view_fields = $this->view_fields[0];
        $controller = $this->controller;
        $permissions = $this->permissions;
        
        $array = $view_fields->field_names;
        $field_names = explode(",", $array);

        $array = $view_fields->table_names;
        $table_names = explode(",", $array);


        try {

            
            return redirect('document_types')->with('status', 'deleted', 'collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names');
        } catch (\Exception $e) {
            dd($e);
        }

    }
}
