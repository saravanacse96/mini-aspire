<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'user_type' => 'required|string'
        ]);

        if($validator->fails()){
            return $this->error('Validation Error.', $validator->errors(),401);       
        }
        
        $user = User::create([
            'name' => $input['name'],
            'password' => bcrypt($input['password']),
            'email' => $input['email'],
            'user_type' => $input['user_type'],
        ]);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

         if($validator->fails()){
            return $this->error('Validation Error.', $validator->errors(),401);       
        }
        
        if (!Auth::attempt($input)) {
            return $this->error('Validation Error.','Credentials not match', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->success(
            [
                'user' => [],
            ],
            'User Logout Successfully'
        );
        
    }
}
