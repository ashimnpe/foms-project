<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if($validate->fails()){
            return parent::resp(false, $validate->errors(), 401);
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return parent::resp(true, 'User Created Successfully!', 201);
        } catch (\Throwable $th) {
            return parent::resp(false, $th->getMessage());
        }

    }


    public function login(Request $request)
    {
        $validate = Validator::make($request->only('email', 'password'), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return parent::resp(false, $validate->errors(), 403);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return parent::resp(false, 'Unauthorized', 401);
        }

        $user = User::where('email', $request->email)->first();

        return parent::resp(true, [
            'user' => $user,
            'token' => $user->createToken('api_token')->plainTextToken
        ], 200);
    }
}
