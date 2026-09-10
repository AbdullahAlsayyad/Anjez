@extends('layouts.admin')

@section('title', 'إضافة خدمة جديدة')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-black text-navy-800">بيانات الخدمة الجديدة</h2>
            <p class="text-xs text-slate-500">أدخل تفاصيل الخدمة ليتم عرضها في صفحة الهبوط فوراً.</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-500 hover:text-navy-800">
            ← إلغاء والعودة للقائمة
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
        <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">عنوان الخدمة</label>
                    <input type="text" name="title" value="{{ old('title') }}" required 
                           placeholder="مثال: إنشاء بحوث وتوثيق علمي"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">الرابط المخصص (Slug) - اختياري</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" 
                           placeholder="research-creation" dir="ltr"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">رمز الأيقونة</label>
                    <select name="icon" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                        <option value="book-open">book-open (بحوث وقراءة)</option>
                        <option value="mail">mail (دعوات ومراسلات)</option>
                        <option value="file-text">file-text (سيرة ذاتية ومستندات)</option>
                        <option value="send">send (خطابات تقديم وإرسال)</option>
                        <option value="layers">layers (مذكرات وتقارير)</option>
                        <option value="trending-up">trending-up (دراسات جدوى)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">ترتيب الظهور</label>
                    <input type="number" name="order" value="{{ old('order', 1) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">الوصف المختصر للخدمة</label>
                <textarea name="short_description" rows="3" required 
                          placeholder="وصف جذاب ودقيق لمحتوى وما تقدمه الخدمة للعميل..."
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-ocean-500 outline-none">{{ old('short_description') }}</textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded text-ocean-600 focus:ring-ocean-500">
                    <span class="text-xs font-bold text-slate-700">تفعيل الخدمة فوراً وعرضها في الصفحة الرئيسية</span>
                </label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">إلغاء</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs shadow transition-colors">
                    حفظ الخدمة
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
