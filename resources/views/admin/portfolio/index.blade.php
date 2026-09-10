@extends('layouts.admin')

@section('title', 'معرض النماذج والأعمال')

@section('content')
<div class="space-y-6">
    
    <!-- Action Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <h2 class="text-lg font-black text-navy-800">عينات ونماذج الأعمال</h2>
            <p class="text-xs text-slate-500">إدارة الصور والعينات المعروضة للزوار لتعزيز الثقة وجذب الطلبات.</p>
        </div>
        <a href="{{ route('admin.portfolio.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs shadow transition-colors">
            <span>+ إضافة نموذج عمل جديد</span>
        </a>
    </div>

    <!-- Filter by Service -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 flex items-center gap-3">
        <span class="text-xs font-bold text-slate-600">تصفية العرض:</span>
        <form action="{{ route('admin.portfolio.index') }}" method="GET" class="flex items-center gap-3">
            <select name="service_id" onchange="this.form.submit()" class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 outline-none">
                <option value="">جميع الخدمات</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->title }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Samples Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($items as $item)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="relative aspect-[3/4] bg-slate-100 overflow-hidden">
                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-white/95 text-navy-800 shadow">
                            {{ $item->service->title ?? 'خدمة' }}
                        </span>
                    </div>
                    @if($item->is_featured)
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-ocean-500 text-white shadow">
                            مميز
                        </span>
                    </div>
                    @endif
                </div>

                <div class="p-5">
                    <h4 class="font-bold text-sm text-navy-800">{{ $item->title }}</h4>
                    @if($item->description)
                    <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">{{ $item->description }}</p>
                    @endif
                </div>
            </div>

            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <span class="text-xs text-slate-400 font-bold">الترتيب: {{ $item->order }}</span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.portfolio.edit', $item) }}" 
                       class="p-1.5 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-ocean-600 transition-colors" title="تعديل">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>

                    <form action="{{ route('admin.portfolio.destroy', $item) }}" method="POST" onsubmit="return confirm('هل تريد بالتأكيد حذف هذا النموذج؟');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-rose-600 transition-colors" title="حذف">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-slate-200">
            <p class="text-slate-500 font-bold text-sm">لا توجد نماذج أعمال مضافة حالياً.</p>
        </div>
        @endforelse
    </div>

    <div class="pt-4">
        {{ $items->links() }}
    </div>

</div>
@endsection
