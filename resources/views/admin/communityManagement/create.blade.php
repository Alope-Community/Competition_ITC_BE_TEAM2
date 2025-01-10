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
      <h2 class="text-lg font-semibold">Form Tambah Pengguna</h2>
      <a href="{{ route('communityManagement.index') }}" 
         class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 focus:outline-none focus:ring focus:ring-gray-300">
         Kembali
      </a>
    </div>

    <form action="{{ route('communityManagement.store') }}" method="POST" class="space-y-4">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Name -->
        <div class="col-span-2">
          <label for="name" class="mx-3 block text-sm font-medium text-gray-700">Nama</label>
          <input type="text" id="name" name="name" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan nama pengguna" value="{{ old('name') }}" required>
          @error('name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Email -->
        <div class="col-span-2">
          <label for="email" class="mx-3 block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan email pengguna" value="{{ old('email') }}" required>
          @error('email')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="col-span-2">
          <label for="password" class="mx-3 block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan password" required>
          @error('password')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div class="col-span-2">
          <label for="password_confirmation" class="mx-3 block text-sm font-medium text-gray-700">Konfirmasi Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Konfirmasi password" required>
          @error('password_confirmation')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Role -->
        <div class="col-span-2">
          <label for="role" class="mx-3 block text-sm font-medium text-gray-700">Role</label>
          <select id="role" name="role" class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            <option value="yayasan/organisasi/komunitas" {{ old('role') == 'yayasan/organisasi/komunitas' ? 'selected' : '' }}>Yayasan/Organisasi/Komunitas</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
          </select>
          @error('role')
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
