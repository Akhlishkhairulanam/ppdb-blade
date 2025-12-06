@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Pendaftar</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $total }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Menunggu Verifikasi</p>
                        <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ $pending }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Diterima</p>
                        <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $accepted }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Ditolak</p>
                        <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $rejected }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6">
                <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.registrations.index') }}"
                        class="block w-full bg-white text-gray-800 px-4 py-3 rounded-lg hover:shadow-md transition text-center font-medium">
                        <i class="fas fa-list mr-2"></i> Lihat Semua Pendaftar
                    </a>
                    <a href="{{ route('admin.export') }}"
                        class="block w-full bg-white text-gray-800 px-4 py-3 rounded-lg hover:shadow-md transition text-center font-medium">
                        <i class="fas fa-download mr-2"></i> Export Data Diterima
                    </a>
                </div>
            </div>

            <!-- Recent Registrations -->
            <div class="md:col-span-2 bg-white rounded-xl shadow p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800">Pendaftaran Terbaru</h3>
                    <a href="{{ route('admin.registrations.index') }}"
                        class="text-purple-600 hover:text-purple-800 text-sm">
                        Lihat semua →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 text-gray-600 font-medium">No. Pendaftaran</th>
                                <th class="text-left py-3 text-gray-600 font-medium">Nama</th>
                                <th class="text-left py-3 text-gray-600 font-medium">Status</th>
                                <th class="text-left py-3 text-gray-600 font-medium">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentRegistrations as $reg)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3">
                                        <a href="{{ route('admin.registrations.show', $reg->id) }}"
                                            class="text-purple-600 hover:text-purple-800">
                                            {{ $reg->no_pendaftaran }}
                                        </a>
                                    </td>
                                    <td class="py-3">{{ $reg->nama }}</td>
                                    <td class="py-3">
                                        <span class="badge badge-{{ $reg->status }}">
                                            @if ($reg->status == 'menunggu')
                                                Menunggu
                                            @elseif($reg->status == 'diterima')
                                                Diterima
                                            @else
                                                Ditolak
                                            @endif
                                        </span>
                                    </td>
                                    <td class="py-3 text-sm text-gray-500">
                                        {{ $reg->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Statistics Chart -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-bold text-gray-800 mb-6">Statistik Pendaftaran</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-blue-50 mb-4">
                        <span class="text-3xl font-bold text-blue-600">{{ $total }}</span>
                    </div>
                    <p class="font-medium">Total Pendaftar</p>
                </div>

                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-50 mb-4">
                        <span class="text-3xl font-bold text-green-600">{{ $accepted }}</span>
                    </div>
                    <p class="font-medium">Diterima</p>
                    <p class="text-sm text-gray-500">{{ $total > 0 ? round(($accepted / $total) * 100, 1) : 0 }}% dari
                        total
                    </p>
                </div>

                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-50 mb-4">
                        <span class="text-3xl font-bold text-red-600">{{ $rejected }}</span>
                    </div>
                    <p class="font-medium">Ditolak</p>
                    <p class="text-sm text-gray-500">{{ $total > 0 ? round(($rejected / $total) * 100, 1) : 0 }}% dari
                        total
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
