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
      <h2 class="text-lg font-semibold">Form Tambah Testimonial</h2>
      <a href="{{ route('testimonial.index') }}" 
         class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 focus:outline-none focus:ring focus:ring-gray-300">
         Kembali
      </a>
    </div>

    <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf

      <div class="grid grid-cols-1 gap-4">
        <!-- Name -->
        <div class="col-span-1">
          <label for="name" class="mx-3 block text-sm font-medium text-gray-700">Nama</label>
          <input type="text" id="name" name="name" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan nama" value="{{ old('name') }}" required>
          @error('name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Position -->
        <div class="col-span-1">
          <label for="position" class="mx-3 block text-sm font-medium text-gray-700">Jabatan</label>
          <input type="text" id="position" name="position" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan jabatan" value="{{ old('position') }}" required>
          @error('position')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Content -->
        <div class="col-span-1">
          <label for="content" class="mx-3 block text-sm font-medium text-gray-700">Testimoni</label>
          <textarea id="content" name="content" rows="4" 
                    class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan testimoni" required>{{ old('content') }}</textarea>
          @error('content')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Photo URL -->
        <div class="col-span-1">
          <label for="photo_url" class="mx-3 block text-sm font-medium text-gray-700">Foto</label>
          <input type="file" id="photo_url" name="photo_url" 
                 class="mt-1 block w-full text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
          @error('photo_url')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button type="submit" 
                class="mr-5 mb-5 bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
          Simpan
        </button>
      </div>
    </form>
  </div>
  <!-- End Form Section -->
</div>
@endsection