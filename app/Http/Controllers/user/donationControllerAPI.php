<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class donationControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::get();
        $data = [
            'status' => 'success',
            'message' => 'Data donations retrieved successfully',
            'data' => $donations->map(function ($donation) {
                return [
                    'id' => $donation->id,
                    'title' => $donation->title,
                    'description' => $donation->description,
                    'category' => $donation->category,
                    'donation_url' => $donation->donation_url,
                    'web_url' => $donation->web_url,
                    'image_url' => $donation->image_url,
                    'status' => $donation->status,
                    'created_at' => $donation->created_at->toDateString(),
                    'updated_at' => $donation->updated_at->toDateString(),
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
            'donation_url' => 'nullable|url',
            'web_url' => 'nullable|url',
            'image_url' => 'nullable|url',
            'status' => 'nullable|string|in:Aktif,Non-Aktif',
        ]);

        $donation = Donation::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Donation created successfully',
            'data' => $donation,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donation = Donation::find($id);

        if (!$donation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Donation not found',
            ], 404);
        }

        $data = [
            'id' => $donation->id,
            'title' => $donation->title,
            'description' => $donation->description,
            'category' => $donation->category,
            'donation_url' => $donation->donation_url,
            'web_url' => $donation->web_url,
            'image_url' => $donation->image_url,
            'status' => $donation->status,
            'created_at' => $donation->created_at->toDateString(),
            'updated_at' => $donation->updated_at->toDateString(),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Donation data retrieved successfully',
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
        $donation = Donation::find($id);

        if (!$donation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Donation not found',
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'donation_url' => 'nullable|url',
            'web_url' => 'nullable|url',
            'image_url' => 'nullable|url',
            'status' => 'nullable|string|in:Aktif,Non-Aktif',
        ]);

        $donation->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Donation updated successfully',
            'data' => $donation,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donation = Donation::find($id);

        if (!$donation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Donation not found',
            ], 404);
        }

        $donation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Donation deleted successfully',
        ], 200);
    }
}
