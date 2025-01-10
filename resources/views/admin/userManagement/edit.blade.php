@extends('admin.layout')

@section('content')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
  <!-- Flash Messages -->
  @if(session('error'))
    <div class="flex items-center bg-red-500 text-white px-4 py-2 rounded mb-4">
        <span class="mr-2 material-icons">error_outline</span>
        {{ session('error') }}
    </div>
  @endif

  @if($errors->any())
    <div class="bg-yellow-500 text-white px-4 py-2 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif  

  <!-- Form Card -->
  <div class="card max-w-4xl mx-auto">
    <div class="card-header flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Edit User</h2>
      <a href="{{ route('userManagement.index') }}" 
         class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 focus:outline-none focus:ring focus:ring-gray-300">
         Kembali
      </a>
    </div>

    <form action="{{ route('userManagement.update', $user->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Name -->
        <div class="col-span-2">
          <label for="name" class="block text-sm font-medium">Nama</label>
          <input type="text" id="name" name="name" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan nama pengguna" value="{{ old('name', $user->name) }}" required>
          @error('name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Email -->
        <div class="col-span-2">
          <label for="email" class="block text-sm font-medium">Email</label>
          <input type="email" id="email" name="email" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan email pengguna" value="{{ old('email', $user->email) }}" required>
          @error('email')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Role -->
        <div class="col-span-2">
          <label for="role" class="block text-sm font-medium">Role</label>
          <select id="role" name="role" 
                  class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="yayasan/organisasi/komunitas" {{ old('role', $user->role) == 'yayasan/organisasi/komunitas' ? 'selected' : '' }}>Yayasan/Organisasi/Komunitas</option>
            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
          </select>
          @error('role')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="col-span-2">
          <label for="password" class="block text-sm font-medium">Password Baru</label>
          <input type="password" id="password" name="password" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Kosongkan jika tidak ingin mengubah password">
          <small class="text-gray-500">Isi hanya jika ingin mengganti password.</small>
          @error('password')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>

        <!-- Password Confirmation -->
        <div class="col-span-2">
          <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Password Baru</label>
          <input type="password" id="password_confirmation" name="password_confirmation" 
                 class="mt-1 block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                 placeholder="Masukkan kembali password baru">
          @error('password_confirmation')
            <div class="text-red-500 text-sm">{{ $message }}</div>
          @enderror
        </div>
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
</div>
@endsection
