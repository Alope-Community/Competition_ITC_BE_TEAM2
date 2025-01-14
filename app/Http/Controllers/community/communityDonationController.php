<?php

namespace App\Http\Controllers\community;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;

class communityDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $donations = $user->donations;

        return view('community.donation.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('community.donation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'donation_url' => 'nullable|string|max:15',
            'web_url' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
        ]);
    
        if ($request->hasFile('image_url')) {
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/donation', $imageName, 'public');
            $validated['image_url'] = $imagePath;
        } else {
            $validated['image_url'] = 'img/donation/donation-default.png';
        }
    
        $user = Auth::user();
        $user->donations()->create($validated);
    
        return redirect()->route('communityDonation.index')->with('success', 'Donation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $donation = $user->donations()->with('user')->findOrFail($id);
        return view('community.donation.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        $donation = $user->donations()->findOrFail($id);
    
        return view('community.donation.edit', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $donation = $user->donations()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'donation_url' => 'nullable|string|max:225',
            'web_url' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        if ($request->hasFile('image_url')) {
            if ($donation->image_url && Storage::exists('public/storage/' . $donation->image_url)) {
                Storage::delete('public/storage/' . $donation->image_url);
            }
    
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/donation', $imageName, 'public');
            $validated['image_url'] = $imagePath;
        } else {
            $validated['image_url'] = $donation->image_url;
        }

        $donation->update($validated);
    
        return redirect()->route('communityDonation.index')->with('success', 'Donation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        $donation = $user->donations()->findOrFail($id);
    
        $donation->delete();
    
        return redirect()->route('communityDonation.index')->with('success', 'Donation deleted successfully.');

    }
}
