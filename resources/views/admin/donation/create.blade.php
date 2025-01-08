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
      <h2 class="text-lg font-semibold">Form Tambah Program Donasi</h2>
      <a href="{{ route('volunteer.index') }}" 
         class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 focus:outline-none focus:ring focus:ring-gray-300">
         Kembali
      </a>
    </div>

    <form action="{{ route('donation.store') }}" method="POST" class="space-y-4">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Title -->
        <div class="col-span-2">
          <label for="title" class="mx-3 block text-sm font-medium text-gray-700">Judul Program</label>
          <input type="text" id="title" name="title" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan judul program" value="{{ old('title') }}" required>
          @error('title')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Description -->
        <div class="col-span-2">
          <label for="description" class="mx-3 block text-sm font-medium text-gray-700">Deskripsi</label>
          <textarea id="description" name="description" rows="4" 
                    class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan deskripsi program" required>{{ old('description') }}</textarea>
          @error('description')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Category -->
        <div class="col-span-2">
          <label for="category" class="mx-3 block text-sm font-medium text-gray-700">Kategori (misal: relawan, donasi)</label>
          <input type="text" id="category" name="category" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan kategori program" value="{{ old('category') }}" required>
          <small class="ml-3 text-gray-500">Masukkan kategori program, pisahkan dengan koma jika lebih dari satu.</small>
          @error('category')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- donation url -->
        <div class="col-span-2">
          <label for="donation_url" class="mx-3 block text-sm font-medium text-gray-700">Link Donasi</label>
          <input type="text" id="donation_url" name="donation_url" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan Link Donasi" value="{{ old('donation_url') }}">
          @error('donation_url')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- web url -->
        <div class="col-span-2">
          <label for="web_url" class="mx-3 block text-sm font-medium text-gray-700">Link Website</label>
          <input type="text" id="web_url" name="web_url" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan Link Website" value="{{ old('web_url') }}">
          @error('web_url')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Status -->
        <div class="col-span-2">
          <label for="status" class="mx-3 block text-sm font-medium text-gray-700">Status</label>
          <select id="status" name="status" 
                  class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
          </select>
          @error('status')
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
