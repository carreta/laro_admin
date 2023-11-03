<?php

namespace App\Http\Controllers\crud\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilController;
use App\Models\Consecutive;
use App\Models\crud\admin\Companies;
use App\Models\crud\admin\DocumentType;
use App\Models\ViewField;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Spatie\Permission\Models\Permission;
use App\Models\crud\admin\GeoCountry;
use App\Models\crud\admin\GeoState;
use App\Models\crud\admin\GeoRegion;
use App\Models\crud\admin\GeoDistrict;
use App\Models\crud\admin\GeoSuburb;
use App\Models\crud\admin\CompanyType;

class CompanyController extends Controller
{

    public function __construct(Request $request)
    {
        $this->search_parameters = '';
        $where = '';

        $name = $request->get('');

        $where_conditional = false;
        
        if($request["name"] != null){
            $where_conditional = true;
            $this->search_parameters = 'name=' . $request->get('name') . "&";
        }

        $this->incident = '1';
        $this->search_parameters = '';
        $this->default_geo_country_id = DB::select("SELECT `geo_country_id` FROM `parameters`");
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
            ->paginate(15)->withQueryString();
        $this->view_fields = ViewField::select('route', 'field_names', 'table_names', 'view_name')->where('route', 'companies')->get();
        $this->permissions = Permission::select('name')->where('name', 'LIKE', "%crud.admin.companies%")->OrderBy('id', 'ASC')->get();
        $this->controller = 'App\Http\Controllers\crud\admin\CompanyController';
        $this->util = new UtilController();

        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::id();

            return $next($request);
        });
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
        $search_parameters = $this->search_parameters;
        
        $array = $view_fields->field_names;
        $field_names = explode(",", $array);

        $array = $view_fields->table_names;
        $table_names = explode(",", $array);


        $incident = $this->incident;

        if(Session::get('status') == "error"){
            $incident = $this->util->ConsecutiveFormat(Consecutive::select('incidents')->get());
        }

        try {
            return view('crud.admin.companies.index', compact('collection', 'view_fields', 'controller', 'permissions', 'field_names', 'table_names', 'search_parameters', 'incident'));
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'companies', 'error', );

            return redirect('/home')->with('status', 'error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_fields = $this->view_fields[0];
        $default_geo_country_id = $this->default_geo_country_id[0]->geo_country_id;

        $document_types = DocumentType::select('hacienda_id', 'name')->get();
        $geo_countries = GeoCountry::select('id', 'name')->get();
        $geo_states = GeoState::select('id', 'name')->get();
        $geo_regions = GeoRegion::select('id', 'name')->get();
        $geo_districts = GeoDistrict::select('id', 'name')->get();
        $geo_suburbs = GeoSuburb::select('id', 'name')->get();
        $company_types = CompanyType::select('id', 'name')->get();
        $customer_modules = DB::select("SELECT `id`, `organization` FROM `customer_modules`");


        return view('crud.admin.companies.create', compact('view_fields', 'document_types', 'geo_countries', 'geo_states', 'geo_regions', 'geo_districts', 'geo_suburbs', 'company_types', 'customer_modules', 'default_geo_country_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::enableQueryLog();

            $companies = Companies::create([
                'holding_id' => 1,
                'name' => $request->name,
                'business_name' => $request->business_name,
                'tradename' => $request->tradename,
                'director' => $request->director,
                'logo' => "logo",
                'document' => $request->document,
                'document_type_id' => $request->document_type_id,
                'address' => $request->address,
                'email' => $request->email,
                'geo_latitud' => $request->geo_latitud,
                'geo_longitud' => $request->geo_longitud,
                'geo_country_id' => $request->geo_country_id,
                'geo_state_id' => $request->geo_state_id,
                'geo_region_id' => $request->geo_region_id,
                'geo_district_id' => $request->geo_district_id,
                'geo_suburb_id' => $request->geo_suburb_id,
                'company_type_id' => $request->company_type_id,
                'customer_module_id' => $request->customer_module_id,
                'apply_taxes' => $request->apply_taxes,
                'apply_contracts' => $request->apply_contracts,
                'active_id' => $request->active_id,
            ]);

            $companies->save();

            $query = DB::getQueryLog();

            $this->util->log($this->user_id, 'companies', 'saved', $query);

            return redirect('companies')->with('status', 'saved');
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'companies', 'error', $query);

            return redirect('companies')->with('status', 'error');
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
            $companies = Companies::select()->where('id', '=', $id)->get();
            
            return view('crud.admin.companies.edit', compact('companies', 'id', 'view_fields', 'search_parameters'));
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'companies', 'error', );

            return redirect('companies')->with('status', 'error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::enableQueryLog();
            Companies::where('id', '=', $id)
                ->update(
                    []
                );

            $query = DB::getQueryLog();

            $this->util->log($this->user_id, 'companies', 'updated', $query);
            
            return redirect('companies')->with('status', 'saved');
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'companies', 'error', );

            return redirect('companies')->with('status', 'error');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $companies = Companies::where('id', '=', )->delete();

            return redirect('companies')->with('status', 'deleted');
        } catch (\Exception $e) {
            $query = $e->getMessage();

            $this->util->log($this->user_id, 'companies', 'error', );

            return redirect('companies')->with('status', 'error');
        }

    }
}