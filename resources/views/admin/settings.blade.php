@extends('layouts.admin')

@section('title', 'إعدادات المنصة وبيانات التواصل')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div>
        <h2 class="text-lg font-black text-navy-800">إعدادات المنصة</h2>
        <p class="text-xs text-slate-500">تعديل رقم الواتساب المخصص لاستقبال الطلبات والنصوص الترويجية للصفحة الرئيسية.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- WhatsApp Section -->
            <div class="p-4 rounded-xl bg-emerald-50/60 border border-emerald-100 space-y-3">
                <div class="flex items-center gap-2 text-emerald-800 font-bold text-sm">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>رقم الواتساب الرئيسي للطلبات</span>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">رقم الواتساب (مع الرمز الدولي الكامل دون مسافات)</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" required 
                           dir="ltr" placeholder="+967770000000"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-navy-800 focus:border-emerald-500 outline-none">
                    <span class="text-[11px] text-slate-500 block mt-1">توجّه كافة أزرار الطلب والزر العائم FAB إلى هذا الرقم مباشرة.</span>
                </div>
            </div>

            <!-- Hero Section Headlines -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-navy-800 border-r-4 border-ocean-500 pr-2">نصوص الواجهة الرئيسية (Hero Section)</h3>
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">العنوان الترويجي الرئيسي</label>
                    <input type="text" name="hero_headline" value="{{ old('hero_headline', $settings['hero_headline']) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">النص التوضيحي للخدمات (Subheadline)</label>
                    <textarea name="hero_subheadline" rows="3" required 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">{{ old('hero_subheadline', $settings['hero_subheadline']) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">نبذة عن منصة أنجز (About Text)</label>
                    <textarea name="about_text" rows="4" required 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">{{ old('about_text', $settings['about_text']) }}</textarea>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs shadow transition-colors">
                    حفظ كافة الإعدادات
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
