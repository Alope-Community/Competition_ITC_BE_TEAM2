<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class testimonialControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        
        $data = [
            'status' => 'success',
            'message' => 'Data testimonials retrieved successfully',
            'data' => $testimonials->map(function ($testimonial) {
                return [
                    'id' => $testimonial->id,
                    'name' => $testimonial->name,
                    'position' => $testimonial->position,
                    'content' => $testimonial->content,
                    'photo_url' => $testimonial->photo_url,
                    'created_at' => $testimonial->created_at->toDateString(),
                    'updated_at' => $testimonial->updated_at->toDateString(),
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
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'content' => 'required|string',
            'photo_url' => 'nullable|url',
        ]);

        $testimonial = Testimonial::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial created successfully',
            'data' => $testimonial,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'status' => 'error',
                'message' => 'Testimonial not found',
            ], 404);
        }

        $data = [
            'id' => $testimonial->id,
            'name' => $testimonial->name,
            'position' => $testimonial->position,
            'content' => $testimonial->content,
            'photo_url' => $testimonial->photo_url,
            'created_at' => $testimonial->created_at->toDateString(),
            'updated_at' => $testimonial->updated_at->toDateString(),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial data retrieved successfully',
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
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'status' => 'error',
                'message' => 'Testimonial not found',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'photo_url' => 'nullable|url',
        ]);

        $testimonial->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial updated successfully',
            'data' => $testimonial,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'status' => 'error',
                'message' => 'Testimonial not found',
            ], 404);
        }

        $testimonial->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial deleted successfully',
        ], 200);
    }
}
