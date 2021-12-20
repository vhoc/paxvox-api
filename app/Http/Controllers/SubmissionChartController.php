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

        // Select the submissions between the specified dates and belonging to the specified location.
        $submissions_by_date_and_locaton = Submission::whereBetween('created_at', [$start_date, $end_date])->where('id_location', $id_location)->get();

        // Extract only the 'responses' child object from the $submissions_by_date_and_locaton parent object.
        $submissions_responses = [];//
        foreach ( $submissions_by_date_and_locaton as $submission => $value )
        {
            array_push($submissions_responses, $value->responses);
        }

        foreach ( $submissions_responses as $response_element )
        {
            $element = $response_element;
            //$elements[ $element->mesero ]++;
        }

        return response()->json($element);


        
        return response()->json($submissions_responses);
    }

}
