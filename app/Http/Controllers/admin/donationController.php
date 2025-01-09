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

        if ($request->hasFile('image_url')) {
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/donation', $imageName, 'public');
            $validatedData['image_url'] = $imagePath;
        } else {
            $validatedData['image_url'] = 'img/donation/donation-default.png';
        }
    
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

        $donation = Donation::findOrFail($id);

        if ($request->hasFile('image_url')) {
            if ($donation->image_url && Storage::exists('public/storage/' . $donation->image_url)) {
                Storage::delete('public/storage/' . $donation->image_url);
            }
    
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('image_url')->storeAs('img/donation', $imageName, 'public');
            $validatedData['image_url'] = $imagePath;
        } else {
            $validatedData['image_url'] = $donation->image_url;
        }

        $donation->update($validatedData);

        return redirect()->route('donation.index')->with('success', 'Program berhasil diperbarui!');
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
    
        return redirect()->route('donation.index')->with('success', 'Program deleted successfully');
    }
}
