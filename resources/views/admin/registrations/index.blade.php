@extends('layouts.app')

@section('title', 'Data Pendaftar PPDB')

@section('content')
    <div class="min-h-screen bg-gray-100 py-8 px-4">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- HEADER --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Data Pendaftar PPDB
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Daftar seluruh calon siswa yang telah mendaftar
                </p>
            </div>

            {{-- TABLE CARD --}}
            <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left">No</th>
                            <th class="px-6 py-3 text-left">No Pendaftaran</th>
                            <th class="px-6 py-3 text-left">Nama</th>
                            <th class="px-6 py-3 text-left">NIK</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y text-sm">
                        @forelse ($registrations as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $registrations->firstItem() + $index }}
                                </td>

                                <td class="px-6 py-4 font-medium text-indigo-600">
                                    {{ $item->no_pendaftaran }}
                                </td>

                                <td class="px-6 py-4 text-gray-800">
                                    {{ $item->nama }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $item->nik }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($item->status === 'diterima')
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ✅ Diterima
                                        </span>
                                    @elseif ($item->status === 'ditolak')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ❌ Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ⏳ Menunggu
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.registrations.show', $item->id) }}"
                                        class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-xs font-medium transition">
                                        <i class="fas fa-eye"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-gray-500">
                                    Belum ada data pendaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- FOOTER ACTION --}}
            <div class="flex justify-between items-center">

                {{-- PAGINATION --}}
                <div>
                    {{ $registrations->links() }}
                </div>

                {{-- KEMBALI DASHBOARD --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-xl text-sm font-medium transition shadow">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>
@endsection
