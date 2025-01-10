@extends('admin.layout')

@section('content')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
    <!-- Show Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Start Quick Info -->
    <div class="grid grid-cols-3 gap-6 mt-6 xl:grid-cols-1">
        <!-- Start User List -->
        <div class="card col-span-3 xl:col-span-1">
            <div class="card-header flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Daftar Pengguna</h2>
                <a href="{{ route('userManagement.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                    + Tambah Pengguna
                </a>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Role</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                                <td class="border px-4 py-2">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('userManagement.edit', $user->id) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded shadow hover:bg-yellow-600 focus:outline-none focus:ring focus:ring-yellow-300">
                                            Edit
                                        </a>
                                        <form action="{{ route('userManagement.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 text-white px-3 py-1 rounded shadow hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center px-4 py-2">Tidak ada data pengguna tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End User List -->
    </div>
    <!-- End Quick Info -->
</div>
@endsection
