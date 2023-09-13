<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthCollection;
use App\Service\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $token = $this->authService->login($request);
            if (!$token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ], 401);
            }
            $user = Auth::user();
            $data = [
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ];
            $result = new AuthCollection(true, 'logged successfully', $data);
            return $result;
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->authService->register($request);

            $token = Auth::login($user);
            
            $data = [
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ];
            
            if($user) 
                $result = new AuthCollection(true, 'User created successfully', $data);
            else
                $result = new AuthCollection(false, 'User created failed', $data);

            return $result;

        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return new AuthCollection(true, 'Successfully logged out', []);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function refresh()
    {
        try {
            $data = [
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ];
            return new AuthCollection(true, 'Successfully logged out', $data);

        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
