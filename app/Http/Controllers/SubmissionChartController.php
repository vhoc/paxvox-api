<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionChartController extends Controller
{
    
    /**
     * meseros()
     */
    public function meseros( Request $request )
    {
        $id_location = $request->id_location;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $filtered = [];

        $selected_submissions = Submission::whereBetween('created_at', [$start_date, $end_date])->where('id_location', $id_location)->get();

       // return response()->json($selected_submissions[8]->responses);

        foreach ( $selected_submissions as $submission => $value )
        {
            array_push($filtered, $value->responses);
        }
        
        return response()->json($filtered);
    }

}
