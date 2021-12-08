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
        $newSubmission = new Submission;

        $newSubmission->cliente_nombre = $request->clienteNombre;
        $newSubmission->cliente_email = $request->clienteEmail;
        $newSubmission->cliente_telefono = $request->clienteTelefono;
        $newSubmission->responses = $request->responses;

        $newSubmission->save();

        return response()->json( 'Envío exitoso.', 201 )
            ->header('Content-Type', 'application/json');
    }

    public function index()
    {
        $submissions = Submission::get();

        return response()->json( $submissions );
    }

    //
}
