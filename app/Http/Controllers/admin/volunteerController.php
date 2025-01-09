<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Volunteer;

class volunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = Volunteer::get();
        return view('admin.volunteer.index', compact('volunteers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.volunteer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'contact_phone' => 'nullable|string|max:15',
            'contact_instagram' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
        ]);

    
        if ($request->hasFile('image_url')) {
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/volunteer', $imageName, 'public');
            $validatedData['image_url'] = $imagePath;
        } else {
            $validatedData['image_url'] = 'img/volunteer/volunteer-default.png';
        }
    
        try {
            Volunteer::create($validatedData);
            return redirect()->route('volunteer.index')->with('success', 'Program relawan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $volunteer = Volunteer::findOrFail($id);
        return view('admin.volunteer.edit', compact('volunteer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $volunteer = Volunteer::findOrFail($id);
    
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'contact_phone' => 'nullable|string|max:15',
            'contact_instagram' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
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
            $validatedData['image_url'] = $imagePath;
        } else {
            $validatedData['image_url'] = $volunteer->image_url;
        }
    
        $volunteer->update($validatedData);
    
        return redirect()->route('volunteer.index')->with('success', 'Program relawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Volunteer::findOrFail($id);
    
        if ($program->image_url && Storage::exists('public/' . $program->image_url)) {
            Storage::delete('public/' . $program->image_url);
        }
    
        $program->delete();
    
        return redirect()->route('volunteer.index')->with('success', 'Program deleted successfully');
    }
}
