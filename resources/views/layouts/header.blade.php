<header x-data="{ mobileOpen: false, scrolled: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)" 
        :class="{ 'bg-white/90 backdrop-blur-md shadow-sm border-b border-slate-200/80': scrolled, 'bg-white/60 backdrop-blur-sm': !scrolled }" 
        class="sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- Brand Logo & Slogan -->
            <a href="#hero" class="flex items-center gap-3.5 group">
                <div class="w-12 h-12 rounded-xl bg-white p-1 border border-slate-200/80 shadow-sm flex items-center justify-center overflow-hidden transition-transform duration-300 group-hover:scale-105">
                    <img src="{{ asset('images/logo.png') }}" alt="شعار أنجز" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-1.5">
                        <span class="text-2xl font-black tracking-tight text-navy-800">أنجز</span>
                        <span class="inline-block w-2 h-2 rounded-full bg-ocean-500 animate-pulse"></span>
                    </div>
                    <span class="text-xs font-semibold text-slate-500">المكان الصحيح لإنجاز أعمالك</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 font-semibold text-sm text-slate-700">
                <a href="#hero" class="hover:text-ocean-600 transition-colors py-1">الرئيسية</a>
                <a href="#services" class="hover:text-ocean-600 transition-colors py-1">خدماتنا</a>
                <a href="#samples" class="hover:text-ocean-600 transition-colors py-1">معرض النماذج</a>
                <a href="#process" class="hover:text-ocean-600 transition-colors py-1">كيف تبدأ؟</a>
                <a href="#about" class="hover:text-ocean-600 transition-colors py-1">عن المنصة</a>
            </nav>

            <!-- CTA Order Button (Desktop) -->
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '967770000000') . '?text=' . urlencode('مرحباً منصة أنجز، أود طلب خدمة جديدة.') }}" 
                   target="_blank"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-navy-800 to-navy-700 hover:from-ocean-600 hover:to-ocean-500 text-white font-bold text-sm shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>اطلب خدمتك الآن</span>
                </a>
            </div>

            <!-- Mobile Menu Hamburger Button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileOpen = !mobileOpen" 
                        type="button" 
                        class="p-2.5 rounded-xl text-navy-800 hover:bg-slate-100 transition-colors focus:outline-none"
                        aria-label="القائمة">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Dropdown Navigation -->
    <div x-show="mobileOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-6 space-y-3 shadow-lg">
        <a @click="mobileOpen = false" href="#hero" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">الرئيسية</a>
        <a @click="mobileOpen = false" href="#services" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">خدماتنا</a>
        <a @click="mobileOpen = false" href="#samples" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">معرض النماذج</a>
        <a @click="mobileOpen = false" href="#process" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">كيف تبدأ؟</a>
        <a @click="mobileOpen = false" href="#about" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">عن المنصة</a>
        <div class="pt-2">
            <a href="{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '967770000000') . '?text=' . urlencode('مرحباً منصة أنجز، أود طلب خدمة جديدة.') }}" 
               target="_blank"
               class="w-full flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-sm shadow-md transition-colors">
                <span>تواصل عبر الواتساب</span>
            </a>
        </div>
    </div>
</header>
