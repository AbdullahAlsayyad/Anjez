@extends('layouts.admin')

@section('title', 'تعديل الخدمة')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-black text-navy-800">تعديل: {{ $service->title }}</h2>
            <p class="text-xs text-slate-500">تحديث تفاصيل الخدمة والترتيب وحالة العرض.</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-500 hover:text-navy-800">
            ← إلغاء والعودة للقائمة
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">عنوان الخدمة</label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">الرابط المخصص (Slug)</label>
                    <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" required 
                           dir="ltr" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">رمز الأيقونة</label>
                    <select name="icon" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                        <option value="book-open" {{ $service->icon == 'book-open' ? 'selected' : '' }}>book-open (بحوث وقراءة)</option>
                        <option value="mail" {{ $service->icon == 'mail' ? 'selected' : '' }}>mail (دعوات ومراسلات)</option>
                        <option value="file-text" {{ $service->icon == 'file-text' ? 'selected' : '' }}>file-text (سيرة ذاتية ومستندات)</option>
                        <option value="send" {{ $service->icon == 'send' ? 'selected' : '' }}>send (خطابات تقديم وإرسال)</option>
                        <option value="layers" {{ $service->icon == 'layers' ? 'selected' : '' }}>layers (مذكرات وتقارير)</option>
                        <option value="trending-up" {{ $service->icon == 'trending-up' ? 'selected' : '' }}>trending-up (دراسات جدوى)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">ترتيب الظهور</label>
                    <input type="number" name="order" value="{{ old('order', $service->order) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">الوصف المختصر للخدمة</label>
                <textarea name="short_description" rows="3" required 
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">{{ old('short_description', $service->short_description) }}</textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }} class="rounded text-ocean-600 focus:ring-ocean-500">
                    <span class="text-xs font-bold text-slate-700">تفعيل الخدمة وعرضها في الصفحة الرئيسية</span>
                </label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">إلغاء</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs shadow transition-colors">
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
