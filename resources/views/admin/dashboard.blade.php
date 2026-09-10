@extends('layouts.admin')

@section('title', 'لوحة التحكم والإحصائيات')

@section('content')
<div class="space-y-8">
    
    <!-- KPI Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Metric 1: Total Services -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-500">إجمالي الخدمات المتاحة</span>
                <div class="text-3xl font-black text-navy-800 mt-2">{{ $stats['total_services'] }}</div>
                <span class="text-xs text-emerald-600 font-bold mt-1 inline-block">{{ $stats['active_services'] }} خدمات مفعلة الآن</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-navy-50 text-navy-800 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        </div>

        <!-- Metric 2: Samples Count -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-500">عينات ونماذج المعرض</span>
                <div class="text-3xl font-black text-navy-800 mt-2">{{ $stats['total_samples'] }}</div>
                <span class="text-xs text-ocean-600 font-bold mt-1 inline-block">{{ $stats['featured_samples'] }} نماذج مميزة</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-ocean-50 text-ocean-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>

        <!-- Metric 3: WhatsApp Number -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-500">رقم الواتساب النشط</span>
                <div class="text-lg font-black text-navy-800 mt-2" dir="ltr">{{ $stats['whatsapp_number'] }}</div>
                <span class="text-xs text-slate-400 font-medium mt-1 inline-block">يستقبل طلبات العملاء</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
            </div>
        </div>

        <!-- Metric 4: Direct Action Button -->
        <div class="bg-gradient-to-br from-navy-800 to-navy-900 rounded-2xl p-6 text-white shadow-sm flex flex-col justify-between">
            <div>
                <span class="text-xs font-bold text-ocean-300">إجراءات سريعة</span>
                <h4 class="text-base font-black mt-1">إضافة نموذج جديد</h4>
            </div>
            <a href="{{ route('admin.portfolio.create') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-ocean-500 hover:bg-ocean-600 text-white text-xs font-bold transition-colors mt-3">
                <span>+ رفع نموذج للعملاء</span>
            </a>
        </div>

    </div>

    <!-- Quick Access Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Services Summary (8 cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-base text-navy-800">الخدمات الأساسية</h3>
                    <p class="text-xs text-slate-500">حالة وتنسيق الخدمات الـ 6 في الموقع</p>
                </div>
                <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-ocean-600 hover:underline">عرض الكل</a>
            </div>

            <div class="divide-y divide-slate-100">
                @foreach($recentServices as $service)
                <div class="py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-lg bg-navy-50 text-navy-800 font-bold text-xs flex items-center justify-center">
                            {{ $service->order }}
                        </span>
                        <div>
                            <span class="font-bold text-sm text-navy-800">{{ $service->title }}</span>
                            <span class="text-xs text-slate-400 block">{{ $service->portfolio_items_count }} نماذج مرتبطة</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $service->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            {{ $service->is_active ? 'مفعلة' : 'معطلة' }}
                        </span>
                        <a href="{{ route('admin.services.edit', $service) }}" class="text-xs font-bold text-slate-500 hover:text-navy-800">تعديل</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Samples (5 cols) -->
        <div class="lg:col-span-5 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-base text-navy-800">أحدث النماذج المضافة</h3>
                    <p class="text-xs text-slate-500">العينات المعروضة للمستخدمين</p>
                </div>
                <a href="{{ route('admin.portfolio.index') }}" class="text-xs font-bold text-ocean-600 hover:underline">عرض الكل</a>
            </div>

            <div class="space-y-3">
                @foreach($recentSamples as $sample)
                <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 transition-colors">
                    <img src="{{ asset($sample->image_path) }}" alt="{{ $sample->title }}" class="w-12 h-12 object-cover rounded-lg border border-slate-200 flex-shrink-0">
                    <div class="flex-grow min-w-0">
                        <h5 class="text-xs font-bold text-navy-800 truncate">{{ $sample->title }}</h5>
                        <span class="text-[11px] text-ocean-600 font-semibold">{{ $sample->service->title ?? 'خدمة' }}</span>
                    </div>
                    <a href="{{ route('admin.portfolio.edit', $sample) }}" class="text-xs font-bold text-slate-400 hover:text-navy-800">تعديل</a>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
@endsection
