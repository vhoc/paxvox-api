<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waiter;

class WaiterController extends Controller
{
    /**
     * Display a listing of the waiters by id_location.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $id_location )
    {
        $waiters = Waiter::where('id_location', $id_location)->get();
        return response()->json( $waiters );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Waiter::create( $request->all() );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
