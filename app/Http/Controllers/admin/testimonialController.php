<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'photo_url' => '-',
            'created_at' => now()
        ]);

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
            'photo_url' => 'nullable|url',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        $testimonial->update([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'content' => $validated['content'],
            'photo_url' => '-',
            'updated_at' => now()
        ]);

        return redirect()->route('testimonial.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Testimonial::findOrFail($id);

        $program->delete();

        return redirect()->route('testimonial.index')->with('success', 'Testimoni deleted successfully');
    }
}
