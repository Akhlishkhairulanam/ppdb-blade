@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-6">Daftar Pendaftar</h2>

        <table class="w-full border">
            <tr class="bg-gray-200">
                <th class="p-3 border">Nama</th>
                <th class="p-3 border">NIK</th>
                <th class="p-3 border">No HP</th>
                <th class="p-3 border">Tanggal</th>
            </tr>

            @foreach ($data as $d)
                <tr>
                    <td class="border p-3">{{ $d->nama }}</td>
                    <td class="border p-3">{{ $d->nik }}</td>
                    <td class="border p-3">{{ $d->no_hp }}</td>
                    <td class="border p-3">{{ $d->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </table>

    </div>
@endsection
