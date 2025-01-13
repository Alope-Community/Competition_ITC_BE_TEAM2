<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Donation;
use App\Models\User;

class donationControllerAPI extends Controller
{
    public function donationRegister(Request $request)
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
            'donation_id' => 'required|exists:donations,id',
        ]);

        $userId = $user->id;
        $donationId = $request->input('donation_id');
    
        $user->volunteer()->attach($donationId, [
            'created_at' => now(),
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Donation registered successfully',
        ]);
    }
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = request('limit');
    
        $query = Donation::query();

        if ($limit) {
            $query->limit($limit);
        }
    
        $donations = $query->get();

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
                    'registration_url' => $donation->registration_url,
                    'start_date' => $donation->start_date,
                    'end_date' => $donation->end_date,
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
            'donation_url' => 'nullable|string|max:255',
            'web_url' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable',
            'status' => 'nullable|string|in:Aktif,Non-Aktif',
            'created_at' => now()
        ]);

        if ($request->hasFile('image_url')) {
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/donation', $imageName, 'public');
            $validated['image_url'] = $imagePath;
        } else {
            $validated['image_url'] = 'img/donation/donation-default.png';
        }

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
            'registration_url' => $donation->registration_url,
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
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
            'donation_url' => 'nullable|string|max:255',
            'web_url' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable',
            'status' => 'nullable|string|in:Aktif,Non-Aktif',
            'updated_at' => now()
        ]);

        if ($request->hasFile('image_url')) {
            if ($donation->image_url && Storage::exists('public/' . $donation->image_url)) {
                Storage::delete('public/' . $donation->image_url);
            }
    
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/donation', $imageName, 'public');
            $validated['image_url'] = $imagePath;
        } else {
            $validated['image_url'] = $volunteer->image_url;
        }

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

        if ($donation->image_url && Storage::exists('public/' . $donation->image_url)) {
            Storage::delete('public/' . $donation->image_url);
        }

        $donation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Donation deleted successfully',
        ], 200);
    }
}
