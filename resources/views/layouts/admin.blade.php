<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم') | منصة أنجز</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Google Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            900: '#091E33',
                            800: '#0F3254',
                            700: '#132F4C',
                            600: '#1B4268',
                            100: '#E6EFF7',
                            50: '#F0F6FA',
                        },
                        ocean: {
                            700: '#0369A1',
                            600: '#0284C7',
                            500: '#0EA5E9',
                            400: '#38BDF8',
                            100: '#E0F2FE',
                            50: '#F0F9FF',
                        }
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #F8FAFC; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen flex text-slate-800 antialiased selection:bg-ocean-100 selection:text-navy-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-navy-900 text-slate-300 flex-shrink-0 hidden md:flex flex-col border-l border-navy-800">
        <!-- Logo Header -->
        <div class="h-20 px-6 flex items-center gap-3 border-b border-navy-800">
            <div class="w-10 h-10 rounded-xl bg-white p-1 flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="أنجز" class="w-full h-full object-contain">
            </div>
            <div>
                <span class="text-xl font-black text-white">لوحة أنجز</span>
                <p class="text-[10px] text-ocean-400 font-semibold">إدارة المنصة والخدمات</p>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-1.5 flex-grow font-semibold text-sm">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-navy-800 text-white font-bold' : 'hover:bg-navy-800/60 text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5 text-ocean-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>الرئيسية والإحصائيات</span>
            </a>

            <a href="{{ route('admin.services.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-navy-800 text-white font-bold' : 'hover:bg-navy-800/60 text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5 text-ocean-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>إدارة الخدمات</span>
            </a>

            <a href="{{ route('admin.portfolio.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.portfolio.*') ? 'bg-navy-800 text-white font-bold' : 'hover:bg-navy-800/60 text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5 text-ocean-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>معرض النماذج والأعمال</span>
            </a>

            <a href="{{ route('admin.settings.edit') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-navy-800 text-white font-bold' : 'hover:bg-navy-800/60 text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5 text-ocean-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>إعدادات المنصة والواتساب</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-navy-800">
            <a href="{{ route('landing') }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span>زيارة الموقع العام</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        
        <!-- Topbar -->
        <header class="h-20 bg-white border-b border-slate-200 px-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-bold text-navy-800">@yield('title', 'لوحة التحكم')</h1>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-sm font-semibold text-slate-600">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span>{{ auth()->user()->name ?? 'مدير المنصة' }}</span>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3.5 py-1.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 hover:text-red-600 transition-colors">
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="mx-6 mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mx-6 mt-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-bold">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Page Body Content -->
        <main class="p-6 flex-grow">
            @yield('content')
        </main>

    </div>

</body>
</html>
