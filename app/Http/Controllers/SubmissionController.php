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
        Submission::create( $request->all() );
    }

    public function index()
    {
        $submissions = Submission::get();

        return response()->json( $submissions );
    }

    //
}
