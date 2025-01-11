<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        $token = $request->bearerToken();

        // Jika token tidak ada
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is required',
            ], 401);
        }

        // Cek token di database
        $user = User::where('remember_token', $token)->first();

        // Jika token tidak valid
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token',
            ], 401);
        }

        // Jika role diberikan dan peran tidak sesuai
        if ($role && $user->role !== $role) {
            return response()->json([
                'status' => 'error',
                'message' => "Unauthorized. This route requires the role: $role",
            ], 403);
        }

        // Simpan data pengguna ke dalam request
        $request->user = $user;

        return $next($request);
    }
}