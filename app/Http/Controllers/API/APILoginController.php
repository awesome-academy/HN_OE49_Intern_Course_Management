<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class APILoginController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(UserStoreRequest $request)
    {
        try {
            $user = $this->userRepo->findUser($request->email)->first();

            if (!Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ])) {
                return response()->json([
                    'status_code' => 500,
                    'message' => __('login-fail'),
                ]);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status_code' => 500,
                'error' => $exception,
            ]);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => __('logout'),
        ], 200);
    }
}
