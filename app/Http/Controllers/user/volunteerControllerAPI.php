<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;

class volunteerControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = Volunteer::get();

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
            'image_url' => 'nullable|url',
            'status' => 'nullable|string|in:Aktif,Non-Aktif',
        ]);

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
            'image_url' => 'nullable|url',
            'status' => 'nullable|string|in:Aktif,Non-Aktif',
        ]);

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

        $volunteer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer deleted successfully',
        ], 200);
    }
}
