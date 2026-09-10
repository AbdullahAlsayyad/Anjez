@extends('layouts.admin')

@section('title', 'إضافة نموذج عمل جديد')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-black text-navy-800">إضافة نموذج عمل إلى المعرض</h2>
            <p class="text-xs text-slate-500">ارفع صورة النموذج واربطها بإحدى الخدمات الأساسية الـ 6.</p>
        </div>
        <a href="{{ route('admin.portfolio.index') }}" class="text-xs font-bold text-slate-500 hover:text-navy-800">
            ← إلغاء والعودة للمعرض
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
        <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">الخدمة التابعة لها</label>
                    <select name="service_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                        <option value="">اختر الخدمة...</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">عنوان النموذج / العمل</label>
                    <input type="text" name="title" value="{{ old('title') }}" required 
                           placeholder="مثال: سيرة ذاتية تنفيذية لمهندس برمجيات"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">ترتيب العرض</label>
                    <input type="number" name="order" value="{{ old('order', 1) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded text-ocean-600 focus:ring-ocean-500">
                        <span class="text-xs font-bold text-slate-700">تمييز كنموذج رئيسي في المعرض</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">صورة النموذج (نسبة طولية 3:4 مفضلة)</label>
                <input type="file" name="image" accept="image/*" required 
                       class="w-full p-2 rounded-xl border border-slate-200 text-xs text-slate-600 file:ml-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-navy-800 file:text-white hover:file:bg-ocean-600 cursor-pointer">
                <p class="text-[11px] text-slate-400 mt-1">يُفضل رفع صور عالية الوضوح بتنسيق JPG, PNG, أو WEBP بحجم لا يتجاوز 5MB.</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">وصف النموذج والتفاصيل</label>
                <textarea name="description" rows="3" 
                          placeholder="تفاصيل حول طريقة التنفيذ، الأدوات المستخدمة، أو المخرجات المسلمة..."
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">{{ old('description') }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.portfolio.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">إلغاء</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs shadow transition-colors">
                    رفع وحفظ النموذج
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
