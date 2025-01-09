@extends('admin.layout')

@section('content')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
  <!-- Show Error Message -->
  @if(session('error'))
    <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
        {{ session('error') }}
    </div>
  @endif

  <!-- Display Validation Errors -->
  @if($errors->any())
    <div class="bg-yellow-500 text-white px-4 py-2 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif  

  <!-- Start Form Section -->
  <div class="card max-w-4xl mx-auto">
    <div class="card-header flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Form Edit Testimonial</h2>
      <a href="{{ route('testimonial.index') }}" 
         class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 focus:outline-none focus:ring focus:ring-gray-300">
         Kembali
      </a>
    </div>

    <form action="{{ route('testimonial.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT') <!-- Use PUT for updating data -->

      <!-- Nama -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" id="name" name="name" 
               class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
               placeholder="Masukkan nama" value="{{ old('name', $testimonial->name) }}" required>
        @error('name')
          <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
      </div>

      <!-- Jabatan -->
      <div>
        <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
        <input type="text" id="position" name="position" 
               class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
               placeholder="Masukkan jabatan" value="{{ old('position', $testimonial->position) }}" required>
        @error('position')
          <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
      </div>

      <!-- Testimoni -->
      <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Testimoni</label>
        <textarea id="content" name="content" rows="4" 
                  class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                  placeholder="Masukkan testimoni" required>{{ old('content', $testimonial->content) }}</textarea>
        @error('content')
          <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
      </div>

      <!-- Upload Gambar -->
      <div>
        <label for="photo_url" class="block text-sm font-medium text-gray-700">Unggah Gambar</label>
        <input type="file" id="photo_url" name="photo_url" 
               class="mt-1 block w-full text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        <small class="text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</small>
        @error('photo_url')
          <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror

        @if($testimonial->photo_url)
          <div class="mt-3">
            <p>Gambar Saat Ini:</p>
            <img src="{{ asset('storage/' . $testimonial->photo_url) }}" alt="Gambar orang" class="w-32 h-32 object-cover rounded">
          </div>
        @endif
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button type="submit" 
                class="bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
  <!-- End Form Section -->
</div>
@endsection
