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

        $selected_submissions = Submission::where('id_location', $id_location)->get();

        return response()->json($selected_submissions);
    }

}
