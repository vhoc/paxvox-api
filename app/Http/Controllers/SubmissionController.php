<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store( Request $request )
    {
        try
        {
            $newSubmission = new Submission;

            $newSubmission->cliente_nombre = $request->clienteNombre;
            $newSubmission->cliente_email = $request->clienteEmail;
            $newSubmission->cliente_telefono = $request->clienteTelefono;
            $newSubmission->responses = $request->responses;
            $newSubmission->id_location = $request->id_location;

            $newSubmission->save();

            return response()->json( 'Envío exitoso.', 201 )
                ->header('Content-Type', 'application/json');
        }
        catch (Exception $e)
        {
            report($e);
            return false;
        }
    }

    public function index()
    {
        $submissions = Submission::get();

        return response()->json( $submissions );
    }

    //
}
