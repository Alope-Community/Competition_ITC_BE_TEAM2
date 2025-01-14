<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class authController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.signin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $validated['role'] = 'yayasan/organisasi/komunitas';

        User::create($validated);

        return redirect()->route('login.index')->with('success', 'Account created successfully. Please login.');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('userManagement.index')->with('success', 'Login successful.');
            }else if ($user->role === 'yayasan/organisasi/komunitas') {
                $request->session()->regenerate();
                return redirect()->route('communityVolunteer.index')->with('success', 'Login successful.');
            }
    
            Auth::logout();
            return back()->withErrors([
                'email' => 'Your role is not authorized to login.',
            ])->onlyInput('email');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/login');
    }
}
