@extends('admin.layout')

@section('content')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
  <div class="card-header flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold">Detile Relawan</h2>
    <a href="{{ route('volunteer.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 focus:outline-none focus:ring focus:ring-gray-300">
       Kembali
    </a>
  </div>

    <!-- Detail Volunteer -->
    <div class="grid grid-cols-2 gap-4 mb-6">
      <!-- Informasi Detail -->
      <div>
        <p><strong>Judul:</strong> {{ $volunteer->title }}</p>
        <p><strong>Deskripsi:</strong> {{ $volunteer->description }}</p>
        <p><strong>Kategori:</strong> {{ ucfirst($volunteer->category) }}</p>
        <p><strong>Kontak:</strong> {{ $volunteer->contact_phone }}</p>
        <p><strong>Instagram:</strong> {{ $volunteer->contact_instagram }}</p>
        <p><strong>Registrasi:</strong> 
          <a href="{{ $volunteer->registration_url }}" target="_blank" class="text-blue-500 hover:underline">
            {{ $volunteer->registration_url }}
          </a>
        </p>
        <p><strong>Tanggal Mulai:</strong> {{ $volunteer->start_date }}</p>
        <p><strong>Tanggal Berakhir:</strong> {{ $volunteer->end_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($volunteer->status) }}</p>
      </div>

      <!-- Gambar -->
      <div>
        <p><strong>Gambar:</strong></p>
        @if($volunteer->image_url)
          <img class="w-32 h-32 object-cover rounded" src="{{ asset('storage/' . $volunteer->image_url) }}" alt="{{ $volunteer->title }}" class="w-full h-auto object-cover rounded">
        @else
          <span class="text-gray-500">Tidak ada gambar</span>
        @endif
      </div>
    </div>

    <!-- Daftar Peserta -->
    <h3 class="text-xl font-semibold mb-4">Daftar Peserta</h3>
    <div class="w-full overflow-x-auto">
      <table class="table-auto w-full text-left border-collapse border border-gray-200">
        <thead>
          <tr class="bg-gray-200">
            <th class="px-4 py-2 border">#</th>
            <th class="px-4 py-2 border">Id</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Tanggal Pendaftaran</th>
          </tr>
        </thead>
        <tbody class="text-gray-600">
          @forelse($volunteer->user as $participant)
            <tr class="hover:bg-gray-50">
              <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
              <td class="border px-4 py-2 text-center">{{ $participant->id }}</td>
              <td class="border px-4 py-2">{{ $participant->name }}</td>
              <td class="border px-4 py-2">{{ $participant->email }}</td>
              <td class="border px-4 py-2">{{ $participant->pivot->created_at }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center px-4 py-2">Belum ada peserta yang mendaftar.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
