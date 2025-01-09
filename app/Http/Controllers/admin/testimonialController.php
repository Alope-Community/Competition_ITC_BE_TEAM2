<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Testimonial;

class testimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'content' => 'required|string',
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo_url')) {
            $extension = $request->file('photo_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('photo_url')->storeAs('img/testimonial', $imageName, 'public');
            $validated['photo_url'] = $imagePath;
        } else {
            $validated['photo_url'] = 'img/testimonial/testimonial-default.png';
        }

        try {
            Testimonial::create($validated);
            return redirect()->route('testimonial.index')->with('success', 'Testimoni berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.' . $e);
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
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'content' => 'required|string',
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        if ($request->hasFile('photo_url')) {
            if ($testimonial->photo_url && Storage::exists('public/storage/' . $testimonial->photo_url)) {
                Storage::delete('public/storage/' . $testimonial->photo_url);
            }
    
            $extension = $request->file('photo_url')->getClientOriginalExtension();
            $imageName = Str::random(20) . '.' . $extension;
            $imagePath = $request->file('photo_url')->storeAs('img/testimonial', $imageName, 'public');
            $validated['photo_url'] = $imagePath;
        } else {
            $validated['photo_url'] = $testimonial->photo_url;
        }
    
        $testimonial->update($validated);

        return redirect()->route('testimonial.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Testimonial::findOrFail($id);

        if ($program->photo_url && Storage::exists('public/' . $program->photo_url)) {
            Storage::delete('public/' . $program->photo_url);
        }
        $program->delete();

        return redirect()->route('testimonial.index')->with('success', 'Testimoni deleted successfully');
    }
}
