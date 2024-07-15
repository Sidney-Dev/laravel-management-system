<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class AuthController extends Controller
{
    // register a new user and send n
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()]);      
        }

        $validated = $validator->validated();
        $validated = $validator->safe()->all();

        // try {

            $user = User::create($validated);

            /**
             * @todo
             * send notification verification email
             */

            return response()->json([
                'success' => true,
                'message' => "User successfully registered.",
            ], 201);

        // } catch (\Exception $error) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => $error->getMessage(),
        //     ], 500);
        // }
    }

    // authenticate user
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()]);      
        }

        $validated = $validator->validated();
        $validated = $validator->safe()->all();
    
        try {
            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) { 
                
                $user = Auth::user(); 
    
                // if (empty($user->email_verified_at)) {
                //     return response()->json([
                //         'success' => false,
                //         'message' => 'You are not allowed to authenticate. Please verify your account first.',
                //         'error' => 'You are not allowed to authenticate. Please verify your account first.',
                //     ], 403);      
                // }
    
                return response()->json([
                    'success' => true,
                    'data' => [
                        'user' => $user,
                        'token' => $user->createToken(env('TOKEN_NAME'))->accessToken,
                    ]
                ], 200);
    
            } else { 
                return response()->json([
                    'success' => false,
                    'message' => 'Error with credentials. Please verify.',
                    'error' => 'Unauthorised'
                ], 401);
            } 
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $error->getMessage()
            ], 400);
        }
    }

    // logout
    public function logout(Request $request)
    {
        try {
            $token = $request->user()->token();
            $token->revoke();
    
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function verify_user(Request $request)
    {
        return redirect()->json([
            'success' => true,
            'message' => 'message'
        ]);
    }

    public function password_reset(Request $request)
    {
        return redirect()->json([
            'success' => true,
            'message' => 'message'
        ]);
    }
    
}
