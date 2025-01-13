<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Volunteer;
use App\Models\User;

class volunteerControllerAPI extends Controller
{
    public function volunteerRegister(Request $request)
    {
        $token = $request->bearerToken();
    
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token is required',
            ], 401);
        }

        $user = User::where('remember_token', $token)->first();
    
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token',
            ], 401);
        }

        $request->validate([
            'volunteer_id' => 'required|exists:volunteers,id',
        ]);

        $userId = $user->id;
        $volunteerId = $request->input('volunteer_id');
    
        $user->volunteer()->attach($volunteerId, [
            'created_at' => now(),
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer registered successfully',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = request('limit');
    
        $query = Volunteer::query();

        if ($limit) {
            $query->limit($limit);
        }
    
        $volunteers = $query->get();
    
        $data = [
            'status' => 'success',
            'message' => 'Data volunteers retrieved successfully',
            'data' => $volunteers->map(function ($volunteer) {
                return [
                    'id' => $volunteer->id,
                    'title' => $volunteer->title,
                    'description' => $volunteer->description,
                    'category' => $volunteer->category,
                    'contact_phone' => $volunteer->contact_phone,
                    'contact_instagram' => $volunteer->contact_instagram,
                    'registration_url' => $volunteer->registration_url,
                    'start_date' => $volunteer->start_date,
                    'end_date' => $volunteer->end_date,
                    'image_url' => $volunteer->image_url,
                    'status' => $volunteer->status,
                    'created_at' => $volunteer->created_at,
                    'updated_at' => $volunteer->updated_at,
                ];
            }),
        ];
    
        return response()->json($data, 200);
    }     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_instagram' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable',
            'status' => 'nullable|string|in:Aktif,Non-Aktif',
        ]);

        if ($request->hasFile('image_url')) {
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/volunteer', $imageName, 'public');
            $validated['image_url'] = $imagePath;
        } else {
            $validated['image_url'] = 'img/volunteer/volunteer-default.png';
        }

        $volunteer = Volunteer::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer created successfully',
            'data' => $volunteer,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Volunteer not found',
            ], 404);
        }

        $data = [
            'id' => $volunteer->id,
            'title' => $volunteer->title,
            'description' => $volunteer->description,
            'category' => $volunteer->category,
            'contact_phone' => $volunteer->contact_phone,
            'contact_instagram' => $volunteer->contact_instagram,
            'registration_url' => $volunteer->registration_url,
            'start_date' => $volunteer->start_date,
            'end_date' => $volunteer->end_date,
            'image_url' => $volunteer->image_url,
            'status' => $volunteer->status,
            'created_at' => $volunteer->created_at->toDateString(),
            'updated_at' => $volunteer->updated_at->toDateString(),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer data retrieved successfully',
            'data' => $data,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $volunteer = Volunteer::find($id);
        
        if (!$volunteer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Volunteer not found',
            ], 404);
        }
    
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_instagram' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable|file|image|max:2048',
            'status' => 'nullable|string|in:Aktif,Non-Aktif',
        ]);
    
        if ($request->hasFile('image_url')) {
            if ($volunteer->image_url && Storage::exists('public/' . $volunteer->image_url)) {
                Storage::delete('public/' . $volunteer->image_url);
            }
    
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/volunteer', $imageName, 'public');
            $validated['image_url'] = $imagePath;
        } else {
            $validated['image_url'] = $volunteer->image_url;
        }
    
        $volunteer->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer updated successfully',
            'data' => $volunteer,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Volunteer not found',
            ], 404);
        }
    
        if ($volunteer->image_url && Storage::exists('public/' . $volunteer->image_url)) {
            Storage::delete('public/' . $volunteer->image_url);
        }
    
        $volunteer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer deleted successfully',
        ], 200);
    }
}
