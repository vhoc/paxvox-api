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
        $submissions_responses = [];
        foreach ( $submissions_by_date_and_locaton as $submission => $value )
        {
            array_push($submissions_responses, $value->responses);
        }

        // Extract the 'meseros' field from 'meseros0
        $meseros = [];
        foreach ( $submissions_responses as $response_element => $value )
        {
            array_push($meseros, $value['mesero']);
        }

        // Create new array with the count of unique 'meseros'
        $meseros_count = array_count_values($meseros);

        // Convert the array into an object usable by the frontend.
        $meseros_responses = [];
        foreach ( $meseros_count as $mesero => $value)
        {
            array_push($meseros_responses, [ "name" => $mesero, "count" => $value ]);
        }
        
        return response()->json($meseros_responses);
    }

    /**
     * frecuencia_de_visita
     */
    public function frecuencia_de_visita( Request $request )
    {
        $id_location = $request->id_location;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Select the submissions between the specified dates and belonging to the specified location.
        $submissions_by_date_and_locaton = Submission::whereBetween('created_at', [$start_date, $end_date])->where('id_location', $id_location)->get();
        //return $submissions_by_date_and_locaton;

        // Extract only the 'responses' child object from the submissions_by_date_and_locaton parent object.
        $submissions_responses = [];
        foreach ( $submissions_by_date_and_locaton as $submission => $value )
        {
            array_push( $submissions_responses, $value->responses );
        }

        // Place the result in a collection and sort them.
        $submissions = collect($submissions_responses);
        $frecuencia = $submissions->sort();
        $frecuencia = $frecuencia->countBy('frecuenciaVisita');

        return response()->json($frecuencia);
    }

    /**
     * atencion_mesero
     */
    public function field_response( Request $request )
    {
        $id_location = $request->id_location;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $field_name = $request->field_name;

        // Select the submissions between the specified dates and belonging to the specified location.
        $submissions_by_date_and_locaton = Submission::whereBetween('created_at', [$start_date, $end_date])->where('id_location', $id_location)->get();

        $submissions_responses = [];
        foreach ( $submissions_by_date_and_locaton as $submission => $value )
        {
            array_push( $submissions_responses, $value->responses );
        }

        $submissions = collect($submissions_responses);
        //$collection_submissions = $submissions->sortBy();
        $field_response = $submissions->countBy( $field_name );
        $field_response_sorted = $field_response->sortKeys();

        return response()->json($field_response_sorted);
    }

}
