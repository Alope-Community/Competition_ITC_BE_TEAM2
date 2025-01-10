<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Testimonial;

class testimonialControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::paginate(3);
    
        $data = [
            'status' => 'success',
            'message' => 'Data testimonials retrieved successfully',
            'data' => $testimonials->getCollection()->map(function ($testimonial) {
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
            'pagination' => [
                'current_page' => $testimonials->currentPage(),
                'last_page' => $testimonials->lastPage(),
                'per_page' => $testimonials->perPage(),
                'total' => $testimonials->total(),
                'next_page_url' => $testimonials->nextPageUrl(),
                'prev_page_url' => $testimonials->previousPageUrl(),
            ],
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
            'name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'photo_url' => 'nullable'
        ]);

        if ($request->hasFile('photo_url')) {
            $extension = $request->file('photo_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('photo_url')->storeAs('img/testimonial', $imageName, 'public');
            $validated['photo_url'] = $imagePath;
        } else {
            $validated['photo_url'] = 'img/testimonial/testimonial-default.png';
        }

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
            'photo_url' => 'nullable',
        ]);

        if ($request->hasFile('photo_url')) {
            if ($testimonial->photo_url && Storage::exists('public/' . $testimonial->photo_url)) {
                Storage::delete('public/' . $testimonial->photo_url);
            }
    
            $extension = $request->file('photo_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('photo_url')->storeAs('img/testimonial', $imageName, 'public');
            $validated['photo_url'] = $imagePath;
        } else {
            $validated['photo_url'] = $testimonial->image_url;
        }

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
