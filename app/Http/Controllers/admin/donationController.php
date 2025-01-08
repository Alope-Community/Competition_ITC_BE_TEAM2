<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class donationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::get();
        return view('admin.donation.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.donation.create');
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
            'donation_url' => 'nullable|string|max:15',
            'web_url' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
        ]);
    
        try {
            Donation::create($validatedData);
            return redirect()->route('donation.index')->with('success', 'Program Donasi berhasil ditambahkan.');
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
        $donation = Donation::findOrFail($id);
        return view('admin.donation.edit', compact('donation'));
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
            'donation_url' => 'nullable|string|max:15',
            'web_url' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $volunteer = Donation::findOrFail($id);

        $volunteer->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'donation_url' => $validated['donation_url'],
            'web_url' => $validated['web_url'],
            'status' => $validated['status'],
            'updated_at' => now()
        ]);

        return redirect()->route('donation.index')->with('success', 'Program berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Donation::findOrFail($id);

        $program->delete();

        return redirect()->route('donation.index')->with('success', 'Program deleted successfully');
    }
}
