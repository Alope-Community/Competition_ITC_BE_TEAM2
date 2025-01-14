<?php

namespace App\Http\Controllers\community;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Volunteer;

class communityVolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $volunteers = $user->volunteers;

        return view('community.volunteer.index', compact('volunteers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('community.volunteer.create');
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
            'contact_phone' => 'nullable|string|max:15',
            'contact_instagram' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
        ]);
    
        if ($request->hasFile('image_url')) {
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/volunteer', $imageName, 'public');
            $validated['image_url'] = $imagePath;
        } else {
            $validated['image_url'] = 'img/volunteer/volunteer-default.png';
        }
    
        $user = Auth::user();
        $user->volunteers()->create($validated);
    
        return redirect()->route('communityVolunteer.index')->with('success', 'Volunteer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $volunteer = $user->volunteers()->with('user')->findOrFail($id);
        return view('community.volunteer.show', compact('volunteer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        $volunteer = $user->volunteers()->findOrFail($id);
    
        return view('community.volunteer.edit', compact('volunteer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $volunteer = $user->volunteers()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'contact_phone' => 'nullable|string|max:15',
            'contact_instagram' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
        ]);
    
        if ($request->hasFile('image_url')) {
            if ($volunteer->image_url && Storage::exists('public/storage/' . $volunteer->image_url)) {
                Storage::delete('public/storage/' . $volunteer->image_url);
            }
    
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/volunteer', $imageName, 'public');
            $validated['image_url'] = $imagePath;
        } else {
            $validated['image_url'] = $volunteer->image_url;
        }
    
        $volunteer->update($validated);
    
        return redirect()->route('communityVolunteer.index')->with('success', 'Volunteer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        $volunteer = $user->volunteers()->findOrFail($id);
    
        $volunteer->delete();
    
        return redirect()->route('communityVolunteer.index')->with('success', 'Volunteer deleted successfully.');
    }
}
