<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string|unique:users',
            'password' => 'required|confirmed',
        ]);

        try 
        {
            $user = new User;
            $user->username= $request->input('username');
            $user->password = app('hash')->make($request->input('password'));
            $user->save();

            return response()->json( [
                        'entity' => 'users', 
                        'action' => 'create', 
                        'result' => 'success'
            ], 201);

        } 
        catch (\Exception $e) 
        {
            return response()->json( [
                       'entity' => 'users', 
                       'action' => 'create', 
                       'result' => 'failed'
            ], 409);
        }
    }
	
     /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */	 
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);

        if (! $token = Auth::attempt($credentials)) {			
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user($token);

        $user_location = Location::where('id', $user->id_location)->pluck('name');

        //return $this->respondWithToken($token);
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'id_location' => $user->id_location,
            'name_location' => $user_location[0]
        ]);
    }
	
     /**
     * Get user details.
     *
     * @param  Request  $request
     * @return Response
     */	 	
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Validate Token
     * 
     * @param Request $request
     * @return Response
     */
    public function validateToken( Request $request )
    {
        $token = '';

        try
        {
            $tokenFetch = auth('api')->authenticate();
            if ( $tokenFetch )
            {
                $token = str_replace( "Bearer ", "", $request->header('Authorization') );
                return response()->json(auth()->user());// Modificar aqui, debe retornar el nombre de la ubicacion como en el metodo login. Eso o modificar el frontend.
                //return response()->json()
            }
            else
            {
                $token = 'Token not found';
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            $token = 'Token is invalid or expired';
        }
    }

    /**
     * Logout method
     * 
     */
    public function logout()
    {
        if( Auth::check() )
        {
            
        }
    }
}