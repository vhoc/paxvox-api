<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    
    public function get( $id )
    {
        $location = Location::where('id', $id)->get();
        return response()->json($location);
    }

}
