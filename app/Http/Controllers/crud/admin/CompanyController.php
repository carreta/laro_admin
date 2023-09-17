<?php

namespace App\Http\Controllers\crud\admin;

use App\Http\Controllers\Controller;
use App\Models\crud\admin\Companies;
use App\Models\ViewField;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(Request $request)
    {
        $this->search_parameters = '';
        $where = '';

        $name = $request->get('name');

        $where_conditional = false;
        
        if($request["name"] != null){
            $where_conditional = true;
            $this->search_parameters = 'name=' . $request->get('name') . "&";
        }

        $this->middleware('can:crud.admin.companies.index')->only('index');
        $this->middleware('can:crud.admin.companies.create')->only('create', 'store');
        $this->middleware('can:crud.admin.companies.edit')->only('edit', 'update');
        $this->middleware('can:crud.admin.companies.destroy')->only('destroy');
        $this->collection = Companies::select('companies.id', 'companies.name', 'director', 'document', 'document_types.name as nameDocumentType', 'address', 'email', 'geo_latitud', 'geo_longitud', 'geo_countries.name as nameGeoCountry', 'geo_states.name as nameGeoState', 'geo_regions.name as nameGeoRegion', 'geo_districts.name as nameGeoDistrict')
            ->join('document_types', 'companies.document_type_id', '=', 'document_types.hacienda_id')
            ->join('geo_countries', 'companies.geo_country_id', '=', 'geo_countries.id')
            ->join('geo_states', 'companies.geo_state_id', '=', 'geo_states.id')
            ->join('geo_regions', 'companies.geo_region_id', '=', 'geo_regions.id')
            ->join('geo_districts', 'companies.geo_district_id', '=', 'geo_districts.id')
            ->join('geo_suburbs', 'companies.geo_suburb_id', '=', 'geo_suburbs.id')
            ->when($where_conditional, function($query) use ($request){
                $where[] = ['companies.name', 'LIKE', '%' . $request->get('name') . '%'];
                $query->where($where);
            })
            ->paginate(1)->withQueryString();
        $this->view_fields = ViewField::select()->get();
        $this->permissions = Permission::select('name')->where('name', 'LIKE', "%crud.admin.companies%")->OrderBy('id', 'ASC')->get();
        $this->controller = 'App\Http\Controllers\crud\admin\CompanyController';
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collection = $this->collection;
        $view_fields = $this->view_fields[0];
        $controller = $this->controller;
        $permissions = $this->permissions;
        $search_parameters = $this->search_parameters;
        
        $array = $view_fields->field_names;
        $field_names = explode(",", $array);
    
        $array = $view_fields->table_names;
        $table_names = explode(",", $array);
    
        // dd($permissions[0] . ' - ' . $permissions[1] . ' - ' . $permissions[3] . ' - ' . $permissions[5]);
        return view('crud.admin.companies.index', compact('collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names', 'search_parameters'));
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
    
        $collection = $this->collection;
        $view_fields = $this->view_fields[0];
        $controller = $this->controller;
        $permissions = $this->permissions;
        
        $array = $view_fields->field_names;
        $field_names = explode(",", $array);
    
        $array = $view_fields->table_names;
        $table_names = explode(",", $array);
    
        DB::insert("INSERT INTO `companies` (`name`, `hacienda_id`) VALUES ('" . $request->name . "', '" . $request->hacienda_id . "') ");
        return redirect('companies')->with('status', 'saved', 'collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names');
        // return view('crud.admin.companies.index', compact('companies', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names'))->withSuccess('LALA');
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
    public function edit(Request $request, string $id)
    {
        
        $view_fields = $this->view_fields[0];
        $controller = $this->controller;        

        
        $search_parameters = $request->session()->get('_previous')["url"];

    
        try {
            // $companies = Companies::select('companies.name', 'director', 'document', 'document_types.name as nameDocumentType', 'address', 'email', 'geo_latitud', 'geo_longitud', 'geo_country_id', 'geo_state_id', 'geo_region_id', 'geo_district_id')->where('id', $id)->get();
            $companies = Companies::select('companies.name', 'director', 'document', 'document_type_id', 'address', 'email', 'geo_latitud', 'geo_longitud', 'geo_country_id', 'geo_state_id', 'geo_region_id', 'geo_district_id')->where('id', '=', $id)->get();
            
            return view('crud.admin.companies.edit', compact('companies', 'id', 'view_fields', 'search_parameters'));
        } catch (\Exception $e) {

            return redirect('companies')->with('status', 'error', 'collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names', 'search_parameters');
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::update("UPDATE `companies` SET `name` = '" . $request->name . "' WHERE `hacienda_id` = '" . $id . "' ");
        return redirect('companies')->with('status', 'updated');
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
    
            
            return redirect('companies')->with('status', 'deleted', 'collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names');
        } catch (\Exception $e) {
            dd($e);
        }
    
    }
}
