<?php

namespace App\Http\Controllers\crud\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilController;
use App\Models\Consecutive;
use App\Models\crud\admin\DocumentType;
use App\Models\ViewField;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Spatie\Permission\Models\Permission;


class DocumentTypeController extends Controller
{

    public function __construct()
    {
        $this->incident = '1';
        $this->search_parameters = '';
        $this->middleware('can:crud.admin.document_types.index')->only('index');
        $this->middleware('can:crud.admin.document_types.create')->only('create', 'store');
        $this->middleware('can:crud.admin.document_types.edit')->only('edit', 'update');
        $this->middleware('can:crud.admin.document_types.destroy')->only('destroy');
        $this->collection = DocumentType::select('hacienda_id', 'name')->paginate(15);
        $this->view_fields = ViewField::select('route', 'field_names', 'table_names', 'view_name')->where('route', 'document_types')->get();
        $this->permissions = Permission::select('name')->where('name', 'LIKE', "%crud.admin.document_types%")->OrderBy('id', 'ASC')->get();
        $this->controller = 'App\Http\Controllers\crud\admin\DocumentTypeController';
        $this->util = new UtilController();

        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::id();

            return $next($request);
        });
        
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $collection = $this->collection;
            $view_fields = $this->view_fields[0];
            $controller = $this->controller;
            $permissions = $this->permissions;
            $search_parameters = $this->search_parameters;
            
            $array = $view_fields->field_names;
            $field_names = explode(",", $array);

            $array = $view_fields->table_names;
            $table_names = explode(",", $array);

            $incident = $this->incident;

            if(Session::get('status') == "error"){
                $incident = $this->util->ConsecutiveFormat(Consecutive::select('incidents')->get());
            }

            return view('crud.admin.document_types.index', compact('collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names', 'search_parameters', 'incident'));            
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'document_types', 'error', $query);

            return redirect('/dashboard')->with('status', 'error');
        }
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
        try {
            DB::enableQueryLog();

            $document_type = DocumentType::create([
                'hacienda_id' => $request->hacienda_id,
                'name' => $request->name
            ]);

            $document_type->save();

            $query = DB::getQueryLog();

            $this->util->log($this->user_id, 'document_types', 'saved', $query);

            return redirect('document_types')->with('status', 'saved');
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'document_types', 'error', $query);

            return redirect('document_types')->with('status', 'error');
        }
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
            $document_types = DocumentType::select('hacienda_id', 'name')->where('hacienda_id', '=', $id)->get();
            return view('crud.admin.document_types.edit', compact('document_types', 'id', 'view_fields'));
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'document_types', 'error', $query);

            return redirect('document_types')->with('status', 'error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            // DB::update("UPDATE `document_types` SET `name` = '" . $request->name . "' WHERE `hacienda_id` = '" . $id . "' ");

            DB::enableQueryLog();

            // dd($request);

            $document_type = DocumentType::where('hacienda_id', '=', $request->get('hacienda_id'))
                ->update(
                   ['name' => $request->name]
                );

            $query = DB::getQueryLog();

            $this->util->log($this->user_id, 'document_types', 'updated', $query);

            return redirect('document_types')->with('status', 'updated');
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'document_types', 'error', $query);

            return redirect('document_types')->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $document_type = DocumentType::where('hacienda_id', '=', $id)->delete();

            return redirect('document_types')->with('status', 'deleted');
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'document_types', 'error', $query);

            return redirect('document_types')->with('status', 'error');
        }
    }
}
