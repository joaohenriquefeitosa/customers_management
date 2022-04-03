<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginValidationFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Throwable;

class AuthController extends Controller
{
    public function login(LoginValidationFormRequest $request): JsonResponse
    {
        try {
            $data = (object)$request->validated();

            $user = User::where('email', $data->email)->first();

            // E-mail not found.
            if (!$user) {
                return response()->json(['status' => false, 'message' => 'User not found!'], Response::HTTP_NOT_FOUND);
            }

            // Check given password
            if (!Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
                return response()->json(['status' => false, 'message' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
            }

            // Return the token
            $token = auth()->user()->createToken(Str::random(6))->accessToken;
            return response()->json($token);

            return response()->json(status: Response::HTTP_UNAUTHORIZED);
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
