<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - PPDB SD IT Baitul Ihsan')</title>

    <!-- Load Tailwind dari CDN (tidak pakai @tailwind) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Atau gunakan CDN yang lengkap -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #374151;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }

        .sidebar-item:hover {
            background-color: #f5f3ff;
            color: #7c3aed;
        }

        .sidebar-item.active {
            background-color: #f5f3ff;
            color: #7c3aed;
            font-weight: 600;
        }

        .stat-card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
            transition: box-shadow 0.3s;
        }

        .stat-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .badge {
            display: inline-flex;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Pastikan warna berbeda untuk aksesibilitas */
        .bg-green-100 {
            background-color: #d1fae5 !important;
        }

        .bg-red-100 {
            background-color: #fee2e2 !important;
        }

        .bg-yellow-100 {
            background-color: #fef3c7 !important;
        }

        .text-green-800 {
            color: #065f46 !important;
        }

        .text-red-800 {
            color: #991b1b !important;
        }

        .text-yellow-800 {
            color: #92400e !important;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="sidebar w-64 bg-white shadow-lg">
            <!-- Logo -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">PPDB Admin</h2>
                        <p class="text-xs text-gray-500">SD IT Baitul Ihsan</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.registrations.index') }}"
                    class="sidebar-item {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    Data Pendaftar
                </a>

                <div class="pt-6 border-t mt-4">
                    <div class="px-4 py-2">
                        <p class="text-sm text-gray-500 mb-2">Logged in as:</p>
                        @php
                            use Illuminate\Support\Facades\Auth;
                        @endphp
                        <p class="font-semibold">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="sidebar-item w-full text-left">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm px-8 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ date('d F Y') }}</span>
                        <a href="{{ route('home') }}" target="_blank" class="text-purple-600 hover:text-purple-800">
                            <i class="fas fa-external-link-alt"></i> Lihat Website
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-8">
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {!! session('success') !!}
                        @if (session('whatsapp_url'))
                            <div class="mt-2">
                                <a href="{{ session('whatsapp_url') }}" target="_blank"
                                    class="inline-flex items-center bg-green-600 text-white px-4 py-2 rounded text-sm">
                                    <i class="fab fa-whatsapp mr-2"></i> Kirim Notifikasi WhatsApp
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Confirm delete
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }

        // Print page
        function printPage() {
            window.print();
        }

        // Toggle sidebar on mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>

</html>
