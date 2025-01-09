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
    <!-- Start Testimonials List -->
    <div class="card col-span-3 xl:col-span-1">
      <div class="card-header flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Daftar Testimonial</h2>
        <a href="{{ route('testimonial.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
           + Tambah Data
        </a>
      </div>

      <div class="w-full overflow-x-auto">
      <table class="table-auto w-full text-left border-collapse border border-gray-200">
        <thead>
          <tr class="bg-gray-200">
            <th class="px-4 py-2 border">#</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Jabatan</th>
            <th class="px-4 py-2 border">Testimoni</th>
            <th class="px-4 py-2 border">Foto</th>
            <th class="px-4 py-2 border">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-gray-600">
          @forelse($testimonials as $testimonial)
            <tr class="hover:bg-gray-50">
              <td class="border px-4 py-2 text-center text-green-500">{{ $loop->iteration }}</td>
              <td class="border px-4 py-2">{{ $testimonial->name }}</td>
              <td class="border px-4 py-2">{{ $testimonial->position }}</td>
              <td class="border px-4 py-2">{{ Str::limit($testimonial->content, 50) }}</td>
              <td class="border px-4 py-2">
                @if($testimonial->photo_url)
                  <img src="{{ asset('storage/' . $testimonial->photo_url) }}" alt="{{ $testimonial->title }}" class="w-16 h-16 object-cover rounded">
                @else
                  <span class="text-gray-500">Tidak ada gambar</span>
                @endif
              </td>
              <td class="border px-4 py-2">
                <div class="flex space-x-2">
                  <a href="{{ route('testimonial.edit', $testimonial->id) }}" 
                     class="bg-yellow-500 text-white px-3 py-1 rounded shadow hover:bg-yellow-600 focus:outline-none focus:ring focus:ring-yellow-300">
                     Edit
                  </a>
                  <form action="{{ route('testimonial.destroy', $testimonial->id) }}" method="POST" class="inline">
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
              <td colspan="6" class="text-center px-4 py-2">Tidak ada data testimonial tersedia.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    </div>
    <!-- End Testimonials List -->
  </div>
  <!-- End Quick Info -->
</div>
@endsection
