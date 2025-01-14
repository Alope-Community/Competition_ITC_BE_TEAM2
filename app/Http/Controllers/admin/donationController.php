<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Donation;
use App\Models\User;

class donationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::with('users')->get();
        return view('admin.donation.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.donation.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
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
        $donation = Donation::with('user')->with('users')->findOrFail($id);
        return view('admin.donation.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donation = Donation::findOrFail($id);
        $users = User::all();
        return view('admin.donation.edit', compact('donation', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'category' => 'required|string',
            'donation_url' => 'nullable|string|max:225',
            'web_url' => 'nullable|string|max:255',
            'registration_url' => 'nullable|string|max:255',
            'start_date' => 'nullable|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|max:2048', // Validate image size and type
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);
    
        $donation = Donation::findOrFail($id);
    
        try {
            // Handle image upload
            if ($request->hasFile('image_url')) {
                if ($donation->image_url && Storage::exists($donation->image_url)) {
                    Storage::delete($donation->image_url); // Correctly handle paths
                }
    
                $imageName = Str::random(20) . '.' . $request->file('image_url')->getClientOriginalExtension();
                $imagePath = $request->file('image_url')->storeAs('img/donation', $imageName, 'public');
                $validatedData['image_url'] = $imagePath;
            }
    
            $donation->update($validatedData);
    
            return redirect()->route('donation.index')->with('success', 'Program berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui program: ' . $e->getMessage());
        }
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Donation::findOrFail($id);
    
        if ($program->image_url && Storage::exists('public/' . $program->image_url)) {
            Storage::delete('public/' . $program->image_url);
        }
    
        $program->delete();
    
        return redirect()->route('donation.index')->with('success', 'Program deleted successfully');
    }
}
