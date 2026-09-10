@extends('layouts.app')

@section('content')

<!-- ==========================================
     HERO SECTION
     ========================================== -->
<section id="hero" class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28 hero-pattern">
    
    <!-- Subtle Background Glow (strictly Navy and Cyan, NO purple) -->
    <div class="absolute top-1/4 right-1/2 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-ocean-100/60 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-1/3 left-10 w-72 h-72 bg-navy-100/40 rounded-full blur-2xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left/Main Hero Copy -->
            <div class="lg:col-span-7 text-center lg:text-right space-y-6">
                
                <!-- Trust Pill Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm text-xs sm:text-sm font-bold text-navy-800">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-ocean-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-ocean-600"></span>
                    </span>
                    <span>المنصة الأولى المعتمدة لخدمات الطلاب ورواد الأعمال</span>
                </div>

                <!-- Main Punchy Headline -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-navy-800 tracking-tight leading-tight sm:leading-none">
                    منصة <span class="text-ocean-600 relative inline-block">
                        أنجز
                        <svg class="absolute -bottom-2 right-0 w-full text-ocean-400/40" height="8" viewBox="0 0 200 8" fill="none" preserveAspectRatio="none">
                            <path d="M0 6C50 1 150 1 200 6" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <br class="hidden sm:inline">
                    <span class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-navy-700 mt-2 block">
                        {{ $settings['hero_headline'] ?? 'المكان الصحيح لإنجاز أعمالك' }}
                    </span>
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    {{ $settings['hero_subheadline'] ?? 'منصتكم الموثوقة لإعداد البحوث العلمية، وتصميم السير الذاتية الاحترافية، وصياغة خطابات التقديم، وتصميم الدعوات الراقية، وإعداد دراسات الجدوى المتكاملة في وقت قياسي وبأعلى معايير الإتقان.' }}
                </p>

                <!-- Quick Bullet-Point Trust Indicators -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-white border border-slate-200/80 shadow-sm">
                        <div class="w-8 h-8 rounded-lg bg-ocean-50 text-ocean-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <span class="block text-xs font-black text-navy-800">سرعة تسليم فائقة</span>
                            <span class="text-[11px] text-slate-500 font-medium">التزام تام بالمواعيد</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-white border border-slate-200/80 shadow-sm">
                        <div class="w-8 h-8 rounded-lg bg-ocean-50 text-ocean-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <span class="block text-xs font-black text-navy-800">احترافية ودقة متناهية</span>
                            <span class="text-[11px] text-slate-500 font-medium">بأيدي خبراء متخصصين</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-white border border-slate-200/80 shadow-sm">
                        <div class="w-8 h-8 rounded-lg bg-ocean-50 text-ocean-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <span class="block text-xs font-black text-navy-800">مراجعات وتعديلات مجانية</span>
                            <span class="text-[11px] text-slate-500 font-medium">حتى الرضا التام</span>
                        </div>
                    </div>
                </div>

                <!-- CTAs Group -->
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '967770000000') . '?text=' . urlencode('مرحباً منصة أنجز، أود الاستفسار وطلب عمل جديد.') }}" 
                       target="_blank"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-navy-800 via-navy-700 to-ocean-600 hover:from-ocean-600 hover:to-ocean-500 text-white font-bold text-base shadow-card hover:shadow-floating transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 text-emerald-400 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span>تواصل واطلب عبر الواتساب فوراً</span>
                    </a>

                    <a href="#samples" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 text-navy-800 font-bold text-base border border-slate-200 shadow-sm hover:border-ocean-300 transition-all duration-300">
                        <svg class="w-5 h-5 text-ocean-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>تصفح النماذج والعينات</span>
                    </a>
                </div>

            </div>

            <!-- Right Hero Card / Showcase Emblem -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md">
                    
                    <!-- Decorative backdrop container -->
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-tr from-ocean-500/20 via-navy-800/10 to-transparent blur-xl"></div>
                    
                    <!-- Main Card -->
                    <div class="relative rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/90 shadow-card">
                        
                        <!-- Official Brand Logo Banner -->
                        <div class="bg-gradient-to-b from-navy-50 to-white rounded-2xl p-6 border border-slate-100 flex flex-col items-center justify-center text-center">
                            <div class="w-28 h-28 sm:w-32 sm:h-32 mb-4 drop-shadow-sm">
                                <img src="{{ asset('images/logo.png') }}" alt="أنجز - الشعار الرسمي" class="w-full h-full object-contain">
                            </div>
                            <div class="inline-block px-3 py-1 rounded-full bg-navy-800 text-white text-xs font-bold tracking-wide">
                                المكان الصحيح لإنجاز أعمالك
                            </div>
                        </div>

                        <!-- Card Metrics / Trust Badges -->
                        <div class="mt-6 grid grid-cols-2 gap-3 text-center">
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-2xl font-black text-navy-800">100%</span>
                                <p class="text-xs text-slate-500 font-semibold mt-0.5">ضمان الجودة والرضا</p>
                            </div>
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-2xl font-black text-ocean-600">+500</span>
                                <p class="text-xs text-slate-500 font-semibold mt-0.5">عمل وبحث منجز</p>
                            </div>
                        </div>

                        <!-- Live Status -->
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span class="flex items-center gap-1.5 font-medium">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                خدمة العملاء نشطة الآن
                            </span>
                            <span class="font-bold text-navy-800">الرد خلال 15 دقيقة</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ==========================================
     SERVICES SHOWCASE SECTION (6 Core Offerings)
     ========================================== -->
<section id="services" class="py-20 bg-white border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block px-4 py-1.5 rounded-full bg-ocean-50 text-ocean-600 text-xs font-extrabold uppercase tracking-wider mb-3">
                خدماتنا المتخصصة
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-navy-800 tracking-tight">
                حلول متكاملة تضمن لك التميز والنجاح
            </h2>
            <p class="text-base text-slate-600 mt-3 leading-relaxed">
                نقدم 6 خدمات رئيسية مخصصة للطلاب، والباحثين، والمهنيين، وأصحاب الأعمال بأعلى مواصفات الإتقان والسرعة.
            </p>
        </div>

        <!-- Services Grid (6 Cards) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $index => $service)
            <div class="group relative rounded-2xl bg-white p-7 border border-slate-200 hover:border-ocean-300 shadow-sm hover:shadow-card transition-all duration-300 flex flex-col justify-between">
                
                <!-- Card Header -->
                <div>
                    <!-- Icon & Index Badge -->
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-navy-800 to-navy-700 text-white flex items-center justify-center shadow-md group-hover:scale-105 group-hover:from-ocean-600 group-hover:to-ocean-500 transition-all duration-300">
                            @if($service->icon === 'book-open')
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            @elseif($service->icon === 'mail')
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            @elseif($service->icon === 'file-text')
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            @elseif($service->icon === 'send')
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            @elseif($service->icon === 'layers')
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            @elseif($service->icon === 'trending-up')
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            @else
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            @endif
                        </div>
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2.5 py-1 rounded-md">
                            0{{ $index + 1 }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-navy-800 group-hover:text-ocean-600 transition-colors mb-2.5">
                        {{ $service->title }}
                    </h3>

                    <!-- Short Description -->
                    <p class="text-sm text-slate-600 leading-relaxed">
                        {{ $service->short_description }}
                    </p>
                </div>

                <!-- Footer Action & Link -->
                <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ $service->whatsapp_order_url }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-1.5 text-xs font-bold text-ocean-600 hover:text-navy-800 transition-colors">
                        <span>اطلب هذه الخدمة</span>
                        <svg class="w-4 h-4 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    @if($service->portfolioItems->count() > 0)
                    <a href="#samples" class="text-xs text-slate-400 hover:text-ocean-600 font-medium transition-colors">
                        {{ $service->portfolioItems->count() }} عينات معروضة
                    </a>
                    @endif
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>


<!-- ==========================================
     SAMPLES GALLERY SECTION (Interactive Filter & Lightbox)
     ========================================== -->
<section id="samples" class="py-20 bg-slateice relative" x-data="{
    activeFilter: 'all',
    lightboxOpen: false,
    activeItem: {
        title: '',
        service: '',
        description: '',
        image: ''
    },
    openLightbox(item) {
        this.activeItem = item;
        this.lightboxOpen = true;
        document.body.style.overflow = 'hidden';
    },
    closeLightbox() {
        this.lightboxOpen = false;
        document.body.style.overflow = 'auto';
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-block px-4 py-1.5 rounded-full bg-ocean-50 text-ocean-600 text-xs font-extrabold uppercase tracking-wider mb-3">
                معرض النماذج والأعمال
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-navy-800 tracking-tight">
                نماذج حقيقية من مخرجاتنا السابقة
            </h2>
            <p class="text-base text-slate-600 mt-3 leading-relaxed">
                تصفح نماذج حية لأعمالنا المصممة بعناية فائقة وتأكد من جودة مخرجاتك قبل طلبها.
            </p>
        </div>

        <!-- Interactive Category Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2.5 mb-12">
            <button @click="activeFilter = 'all'"
                    :class="activeFilter === 'all' ? 'bg-navy-800 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200">
                جميع النماذج
            </button>

            @foreach($services as $service)
            <button @click="activeFilter = 'service-{{ $service->id }}'"
                    :class="activeFilter === 'service-{{ $service->id }}' ? 'bg-navy-800 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                    class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200">
                {{ $service->title }}
            </button>
            @endforeach
        </div>

        <!-- Portfolio Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($portfolioItems as $item)
            <div x-show="activeFilter === 'all' || activeFilter === 'service-{{ $item->service_id }}'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="group rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-card transition-all duration-300 overflow-hidden flex flex-col">
                
                <!-- Image Showcase Container with Hover Overlay -->
                <div class="relative aspect-[3/4] bg-slate-100 overflow-hidden cursor-pointer"
                     @click="openLightbox({
                         title: '{{ addslashes($item->title) }}',
                         service: '{{ addslashes($item->service->title ?? 'خدمة أنجز') }}',
                         description: '{{ addslashes($item->description ?? '') }}',
                         image: '{{ $item->image_url }}'
                     })">
                    
                    <img src="{{ $item->image_url }}" 
                         alt="{{ $item->title }}" 
                         loading="lazy"
                         class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">

                    <!-- Overlay Gradient & Zoom Action -->
                    <div class="absolute inset-0 bg-navy-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4">
                        <div class="text-center transform translate-y-3 group-hover:translate-y-0 transition-transform duration-300">
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white text-navy-800 shadow-lg mb-2">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                </svg>
                            </span>
                            <p class="text-white text-xs font-bold">انقر للتكبير والمعاينة</p>
                        </div>
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-navy-800 backdrop-blur-sm shadow-sm border border-slate-200/60">
                            {{ $item->service->title ?? 'خدمة' }}
                        </span>
                    </div>

                    @if($item->is_featured)
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-ocean-500 text-white shadow-sm">
                            نموذج مميز
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Item Details Below Image -->
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div>
                        <h4 class="font-bold text-base text-navy-800 group-hover:text-ocean-600 transition-colors">
                            {{ $item->title }}
                        </h4>
                        @if($item->description)
                        <p class="text-xs text-slate-500 mt-1.5 line-clamp-2 leading-relaxed">
                            {{ $item->description }}
                        </p>
                        @endif
                    </div>

                    <!-- Action Trigger -->
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <button type="button"
                                @click="openLightbox({
                                    title: '{{ addslashes($item->title) }}',
                                    service: '{{ addslashes($item->service->title ?? 'خدمة أنجز') }}',
                                    description: '{{ addslashes($item->description ?? '') }}',
                                    image: '{{ $item->image_url }}'
                                })"
                                class="text-xs font-bold text-ocean-600 hover:text-navy-800 transition-colors inline-flex items-center gap-1">
                            <span>معاينة النموذج بدقة عالية</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
            @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200">
                <p class="text-slate-500 font-medium">سيتم إضافة نماذج جديدة قريباً.</p>
            </div>
            @endforelse
        </div>

    </div>

    <!-- ==========================================
         LIGHTBOX / MODAL VIEWER (Alpine.js)
         ========================================== -->
    <div x-show="lightboxOpen" 
         x-cloak
         @keydown.escape.window="closeLightbox()"
         class="fixed inset-0 z-50 overflow-y-auto"
         role="dialog" 
         aria-modal="true">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-navy-900/80 backdrop-blur-sm transition-opacity" 
             @click="closeLightbox()"></div>

        <!-- Modal Dialog Box -->
        <div class="min-h-screen px-4 flex items-center justify-center p-4 text-center">
            
            <div x-show="lightboxOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                 class="relative bg-white rounded-3xl max-w-3xl w-full mx-auto overflow-hidden shadow-2xl border border-slate-200 text-right">
                
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                    <div>
                        <span class="inline-block text-xs font-bold text-ocean-600 bg-ocean-50 px-2.5 py-0.5 rounded-md mb-1" x-text="activeItem.service"></span>
                        <h3 class="text-lg font-black text-navy-800" x-text="activeItem.title"></h3>
                    </div>
                    
                    <button type="button" 
                            @click="closeLightbox()" 
                            class="w-10 h-10 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-500 hover:text-navy-800 flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body (Image Container) -->
                <div class="p-6 bg-slate-100/60 max-h-[70vh] overflow-y-auto flex items-center justify-center">
                    <img :src="activeItem.image" 
                         :alt="activeItem.title"
                         class="max-w-full max-h-[60vh] object-contain rounded-xl shadow-md border border-slate-200/80">
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-white border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500 font-medium" x-text="activeItem.description || 'نموذج عمل حقيقي وموثق لمنصة أنجز.'"></p>
                    
                    <a :href="'https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '967770000000') }}?text=' + encodeURIComponent('مرحباً منصة أنجز، أود طلب عمل مماثل لنموذج: ' + activeItem.title)" 
                       target="_blank"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white text-xs font-bold transition-colors">
                        <span>طلب عمل مماثل لهذا النموذج</span>
                        <svg class="w-4 h-4 text-emerald-400 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- ==========================================
     ORDER PROCESS SECTION (كيف تبدأ؟ - 3 خطوات)
     ========================================== -->
<section id="process" class="py-20 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block px-4 py-1.5 rounded-full bg-ocean-50 text-ocean-600 text-xs font-extrabold uppercase tracking-wider mb-3">
                آلية العمل السلسة
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-navy-800 tracking-tight">
                كيف تبدأ بإنجاز عملك معنا؟
            </h2>
            <p class="text-base text-slate-600 mt-3 leading-relaxed">
                3 خطوات ميسرة وسريعة تفصلك عن استلام عملك بأعلى جودة واحترافية.
            </p>
        </div>

        <!-- 3-Step Cards Container -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            
            <!-- Connector Line (Desktop) -->
            <div class="hidden md:block absolute top-1/2 left-1/6 right-1/6 h-0.5 bg-slate-200 -translate-y-8 -z-0"></div>

            <!-- Step 1 -->
            <div class="relative bg-white rounded-2xl p-8 border border-slate-200/90 shadow-sm text-center hover:border-ocean-300 transition-all">
                <div class="w-16 h-16 rounded-2xl bg-navy-800 text-white font-black text-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                    1
                </div>
                <h3 class="text-lg font-bold text-navy-800 mb-2">اختر الخدمة وتصفح النماذج</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    حدد الخدمة التي تحتاجها من بين باقتنا المتخصصة واستعرض عينات الأعمال للتأكد من المعايير المناسبة لك.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="relative bg-white rounded-2xl p-8 border border-slate-200/90 shadow-sm text-center hover:border-ocean-300 transition-all">
                <div class="w-16 h-16 rounded-2xl bg-ocean-600 text-white font-black text-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                    2
                </div>
                <h3 class="text-lg font-bold text-navy-800 mb-2">أرسل التفاصيل عبر الواتساب</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    تواصل معنا بضغطة زر، وزودنا بمتطلبات العمل والموعد النهائي المحدد، وسيقوم فريقنا بتأكيد التفاصيل فوراً.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="relative bg-white rounded-2xl p-8 border border-slate-200/90 shadow-sm text-center hover:border-ocean-300 transition-all">
                <div class="w-16 h-16 rounded-2xl bg-navy-800 text-white font-black text-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                    3
                </div>
                <h3 class="text-lg font-bold text-navy-800 mb-2">استلم عملك جاهزاً ومتقناً</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    يتم تسليم العمل بدقة متناهية وفي الوقت المحدد، مع إتاحة إمكانية المراجعة والتعديل المجاني حتى تمام الرضا.
                </p>
            </div>

        </div>

        <!-- Fast CTA under steps -->
        <div class="mt-12 text-center">
            <a href="{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '967770000000') . '?text=' . urlencode('مرحباً منصة أنجز، أود بدء طلب عمل جديد.') }}" 
               target="_blank"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-ocean-600 hover:bg-ocean-700 text-white font-bold text-sm shadow-md transition-all">
                <span>ابدأ الآن - تواصل مع المستشار عبر الواتساب</span>
                <svg class="w-4 h-4 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>


<!-- ==========================================
     ABOUT / WHY ANJEZ SECTION
     ========================================== -->
<section id="about" class="py-20 bg-slateice">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-6 space-y-6 text-right">
                <span class="inline-block px-4 py-1.5 rounded-full bg-ocean-50 text-ocean-600 text-xs font-extrabold uppercase tracking-wider">
                    لماذا منصة أنجز؟
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-navy-800 tracking-tight leading-snug">
                    نجمع بين الإتقان الأكاديمي، واللمسة الإبداعية، والسرعة الفائقة
                </h2>
                <p class="text-base text-slate-600 leading-relaxed">
                    {{ $settings['about_text'] ?? 'تأسست منصة أنجز لتكون الوجهة الموثوقة الأولى لكل من يبحث عن إتقان أعماله دون عناء. نحن نحرص على تقديم مخرجات تنافسية تلفت الأنظار وتلبي أعلى المعايير المهنية والأكاديمية.' }}
                </p>

                <!-- Value Pillars -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="p-4 rounded-xl bg-white border border-slate-200">
                        <div class="w-8 h-8 rounded-lg bg-navy-800 text-white flex items-center justify-center mb-2 font-bold text-xs">
                            ✓
                        </div>
                        <h4 class="font-bold text-sm text-navy-800">سرية وخصوصية مطلقة</h4>
                        <p class="text-xs text-slate-500 mt-1">كافة بياناتك وملفاتك مشفرة ومحمية بأمان كامل.</p>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-slate-200">
                        <div class="w-8 h-8 rounded-lg bg-ocean-600 text-white flex items-center justify-center mb-2 font-bold text-xs">
                            ✓
                        </div>
                        <h4 class="font-bold text-sm text-navy-800">أسعار مناسبة وتنافسية</h4>
                        <p class="text-xs text-slate-500 mt-1">باقات تسعير مرنة ومناسبة للطلاب ورواد الأعمال.</p>
                    </div>
                </div>
            </div>

            <!-- Visual Showcase -->
            <div class="lg:col-span-6">
                <div class="rounded-3xl bg-gradient-to-br from-navy-800 to-navy-900 p-8 sm:p-10 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-ocean-500/20 rounded-full blur-2xl pointer-events-none"></div>
                    
                    <h3 class="text-2xl font-black mb-4">أنجز أعمالك وأنت مطمئن البال</h3>
                    <p class="text-slate-300 text-sm leading-relaxed mb-8">
                        سواء كنت بحاجة إلى كتابة بحث أكاديمي متقن، أو تصميم سيرة ذاتية تبهر مدراء التوظيف، أو إعداد دراسة جدوى استثمارية لمشروعك، نحن هنا لنحول أفكارك إلى واقع ناجح.
                    </p>

                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-sm font-semibold text-slate-200">
                            <span class="w-2 h-2 rounded-full bg-ocean-400"></span>
                            <span>توثيق علمي معتمد لكافة الأبحاث والدراسات</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm font-semibold text-slate-200">
                            <span class="w-2 h-2 rounded-full bg-ocean-400"></span>
                            <span>تصاميم عصرية متوافقة مع أحدث صيحات الجرافيك</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm font-semibold text-slate-200">
                            <span class="w-2 h-2 rounded-full bg-ocean-400"></span>
                            <span>تواصل مباشر مع المتخصص طوال فترة العمل</span>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-navy-700">
                        <a href="{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '967770000000') . '?text=' . urlencode('مرحباً منصة أنجز، أود مناقشة تفاصيل طلبي.') }}" 
                           target="_blank"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-ocean-500 hover:bg-ocean-600 text-white font-bold text-sm shadow-md transition-all">
                            <span>تحدث مع المستشار الآن</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
