<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use DB;

class UtilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function log($user_id, $route, $session, $query)
    {
        $position = strpos($query[0]["query"], 'values');
        $raw_query = substr($query[0]["query"], 0, $position + 8);
        $data = DB::getQueryLog()[0]["bindings"];        

        for($i = 0; $i < count($data); $i++){
            $raw_query .= $data[$i] . ', ';
        }

        $raw_query = substr(trim($raw_query), 0, -1);

        $raw_query .= ")";

        $util = Log::create([
            'user_id' => $user_id,
            'route' => $route,
            'session' => $session,
            'query' => $query
        ]);
        

        $util->save();

        return 0;
    }
}
