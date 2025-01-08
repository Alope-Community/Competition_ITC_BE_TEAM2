<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'image_url' => 'nullable|url',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
        ]);
    
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
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'contact_phone' => 'nullable|string|max:15',
            'contact_instagram' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $volunteer = Volunteer::findOrFail($id);

        $volunteer->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'contact_phone' => $validated['contact_phone'],
            'contact_instagram' => $validated['contact_instagram'],
            'status' => $validated['status'],
            'updated_at' => now()
        ]);

        return redirect()->route('volunteer.index')->with('success', 'Program berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Volunteer::findOrFail($id);

        $program->delete();

        return redirect()->route('volunteer.index')->with('success', 'Program deleted successfully');
    }
}
