@extends('layouts.admin')

@section('title', 'تعديل نموذج العمل')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-black text-navy-800">تعديل: {{ $portfolio->title }}</h2>
            <p class="text-xs text-slate-500">تحديث تفاصيل النموذج، الصورة، والخدمة التابعة لها.</p>
        </div>
        <a href="{{ route('admin.portfolio.index') }}" class="text-xs font-bold text-slate-500 hover:text-navy-800">
            ← إلغاء والعودة للمعرض
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
        <form action="{{ route('admin.portfolio.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">الخدمة التابعة لها</label>
                    <select name="service_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id', $portfolio->service_id) == $service->id ? 'selected' : '' }}>
                                {{ $service->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">عنوان النموذج / العمل</label>
                    <input type="text" name="title" value="{{ old('title', $portfolio->title) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">ترتيب العرض</label>
                    <input type="number" name="order" value="{{ old('order', $portfolio->order) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $portfolio->is_featured) ? 'checked' : '' }} class="rounded text-ocean-600 focus:ring-ocean-500">
                        <span class="text-xs font-bold text-slate-700">تمييز كنموذج رئيسي</span>
                    </label>
                </div>
            </div>

            <!-- Current Image & Change Option -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">الصورة الحالية للنموذج</label>
                <div class="flex items-center gap-4 mb-3">
                    <img src="{{ asset($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-20 h-24 object-cover rounded-xl border border-slate-200 shadow-sm">
                    <span class="text-xs text-slate-400">اترك الحقل أدناه فارغاً إذا كنت لا ترغب بتغيير الصورة.</span>
                </div>
                <input type="file" name="image" accept="image/*" 
                       class="w-full p-2 rounded-xl border border-slate-200 text-xs text-slate-600 file:ml-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-navy-800 file:text-white hover:file:bg-ocean-600 cursor-pointer">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">وصف النموذج</label>
                <textarea name="description" rows="3" 
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">{{ old('description', $portfolio->description) }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.portfolio.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">إلغاء</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs shadow transition-colors">
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
