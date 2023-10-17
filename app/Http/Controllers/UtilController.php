<?php

namespace App\Http\Controllers;

use App\Models\Consecutive;
use App\Models\Log;
use DB;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function log($user_id, $route, $session, $query)
    {
        $collection = Consecutive::select('incidents')->get();

        if($session == "saved"){
            $position = strpos($query[0]["query"], 'values');
            $raw_query = substr($query[0]["query"], 0, $position + 8);
            $data = DB::getQueryLog()[0]["bindings"];

            for($i = 0; $i < count($data); $i++){
                $raw_query .= $data[$i] . ', ';
            }

            $raw_query = substr(trim($raw_query), 0, -1);

            $raw_query .= ")";

            $query = $raw_query;
        }

        if($session == "updated"){

            $query = $query[0]["query"];

            $data = DB::getQueryLog()[0]["bindings"];

            for($i = 0; $i < count($data); $i++){
                $position = strpos($query, '?');
                $query = substr_replace($query, $data[$i], $position, 1);
            }

        }


        if($session == "error"){            
            $incident = $this->ConsecutiveFormat($collection);

            $consecutive = Consecutive::find(1);
            $consecutive->incidents = $collection[0]->incidents + 1;
            $consecutive->save();
        }


        $util = Log::create([
            'incident' =>  $collection[0]->incidents,
            'user_id' => $user_id,
            'route' => $route,
            'session' => $session,
            'query' => $query
        ]);

        $util->save();


    }

    // 0010332106

    public function ConsecutiveFormat($collection){
        
        $formated_consecutive = '';
        $strlen = 10;
        $string = $strlen - strlen($collection[0]->incidents);

        for($i = 0; $i < $string; $i++){
            $formated_consecutive .= '0';
        }

        $formated_consecutive .= $collection[0]->incidents - 1;

        return $formated_consecutive;

    }
}

