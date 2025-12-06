@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
    <div class="max-w-6xl mx-auto p-6 space-y-6" x-data="{ approve: false, reject: false }">

        <h1 class="text-2xl font-bold text-gray-800">Detail Pendaftar</h1>

        {{-- CARD DATA --}}
        <div class="bg-white rounded-xl shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

            <div>
                <label class="text-gray-500">Nama Lengkap</label>
                <p class="font-semibold">{{ $registration->nama }}</p>
            </div>

            <div>
                <label class="text-gray-500">NIK</label>
                <p class="font-semibold">{{ $registration->nik }}</p>
            </div>

            <div>
                <label class="text-gray-500">TTL</label>
                <p class="font-semibold">
                    {{ $registration->tempat_lahir }}, {{ $registration->tanggal_lahir }}
                </p>
            </div>

            <div>
                <label class="text-gray-500">Status</label>
                <div class="flex items-center gap-2">
                    <span
                        class="font-semibold
                    {{ $registration->status === 'diterima'
                        ? 'text-green-600'
                        : ($registration->status === 'ditolak'
                            ? 'text-red-600'
                            : 'text-yellow-600') }}">
                        {{ ucfirst($registration->status) }}
                    </span>

                    @if ($registration->sudah_dihubungi)
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">
                            ✅ Sudah dihubungi
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- CARD DOKUMEN --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Berkas Pendaftaran</h3>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ([
            'Foto Anak' => $registration->foto_anak,
            'KK' => $registration->foto_kk,
            'Akte' => $registration->foto_akte,
            'KTP Ayah' => $registration->foto_ktp_ayah,
            'KTP Ibu' => $registration->foto_ktp_ibu,
        ] as $label => $file)
                    <div>
                        <p class="text-xs text-gray-500 mb-1">{{ $label }}</p>
                        <a href="{{ asset('storage/' . $file) }}" target="_blank">
                            <img src="{{ asset('storage/' . $file) }}"
                                class="rounded-lg h-32 w-full object-cover border hover:opacity-80">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CARD AKSI --}}
        <div class="bg-white rounded-xl shadow p-5 flex justify-between items-center">

            <div class="flex gap-3">
                @if ($registration->status === 'menunggu')
                    <button @click="approve = true" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                        ✅ Setujui
                    </button>

                    <button @click="reject = true" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">
                        ❌ Tolak
                    </button>
                @endif
            </div>

            <a href="{{ url()->previous() }}" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm">
                ← Kembali
            </a>
        </div>

        {{-- MODAL APPROVE --}}
        <div x-show="approve" class="fixed inset-0 bg-black/50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 w-full max-w-md">
                <h3 class="font-semibold mb-4">Setujui & Hubungi Orang Tua?</h3>
                <form method="POST" action="{{ route('admin.registrations.approve', $registration->id) }}">
                    @csrf
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="approve=false" class="px-4 py-2 bg-gray-200 rounded">Batal</button>
                        <button class="px-4 py-2 bg-green-600 text-white rounded">
                            Ya, Setujui
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL REJECT --}}
        <div x-show="reject" class="fixed inset-0 bg-black/50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 w-full max-w-md">
                <h3 class="font-semibold mb-4">Alasan Penolakan</h3>
                <form method="POST" action="{{ route('admin.registrations.reject', $registration->id) }}">
                    @csrf
                    <textarea required name="alasan_penolakan" class="w-full border rounded-lg p-3 text-sm"
                        placeholder="Masukkan alasan penolakan..."></textarea>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="reject=false" class="px-4 py-2 bg-gray-200 rounded">Batal</button>
                        <button class="px-4 py-2 bg-red-600 text-white rounded">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- AUTO OPEN WHATSAPP --}}
    @if (session('open_whatsapp'))
        <script>
            window.open("{{ session('open_whatsapp') }}", "_blank");
        </script>
    @endif
@endsection
