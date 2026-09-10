@extends('layouts.admin')

@section('title', 'إدارة الخدمات')

@section('content')
<div class="space-y-6">
    
    <!-- Action Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <h2 class="text-lg font-black text-navy-800">قائمة الخدمات المتاحة</h2>
            <p class="text-xs text-slate-500">تحكم بالخدمات المعروضة على الصفحة الرئيسية وترتيب ظهورها وحالتها.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs shadow transition-colors">
            <span>+ إضافة خدمة جديدة</span>
        </a>
    </div>

    <!-- Services Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right text-sm">
                <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase">
                    <tr>
                        <th class="py-4 px-6">الترتيب</th>
                        <th class="py-4 px-6">الخدمة</th>
                        <th class="py-4 px-6">الرابط المخصص (Slug)</th>
                        <th class="py-4 px-6">النماذج المرفقة</th>
                        <th class="py-4 px-6">حالة الظهور</th>
                        <th class="py-4 px-6 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($services as $service)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6 font-bold text-slate-600">
                            <span class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center font-bold text-xs">
                                {{ $service->order }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-navy-50 text-navy-800 flex items-center justify-center font-bold text-xs">
                                    {{ $service->icon }}
                                </div>
                                <div>
                                    <span class="font-bold text-navy-800 text-sm block">{{ $service->title }}</span>
                                    <span class="text-xs text-slate-400 line-clamp-1 max-w-xs">{{ $service->short_description }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-mono text-xs text-slate-500" dir="ltr">
                            {{ $service->slug }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-ocean-50 text-ocean-700">
                                {{ $service->portfolio_items_count }} نماذج
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <button type="button" 
                                    onclick="toggleServiceStatus({{ $service->id }})"
                                    id="status-badge-{{ $service->id }}"
                                    class="px-3 py-1 rounded-full text-xs font-bold cursor-pointer transition-colors {{ $service->is_active ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                {{ $service->is_active ? 'مفعلة' : 'معطلة' }}
                            </button>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" 
                                   class="p-2 rounded-lg bg-slate-100 hover:bg-ocean-50 text-slate-600 hover:text-ocean-600 transition-colors"
                                   title="تعديل">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة؟ سيتم حذف جميع النماذج المرتبطة بها.');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 transition-colors"
                                            title="حذف">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function toggleServiceStatus(id) {
    fetch(`/admin/services/${id}/toggle-active`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            const badge = document.getElementById(`status-badge-${id}`);
            if(data.is_active) {
                badge.className = 'px-3 py-1 rounded-full text-xs font-bold cursor-pointer transition-colors bg-emerald-50 text-emerald-700 hover:bg-emerald-100';
                badge.innerText = 'مفعلة';
            } else {
                badge.className = 'px-3 py-1 rounded-full text-xs font-bold cursor-pointer transition-colors bg-slate-100 text-slate-500 hover:bg-slate-200';
                badge.innerText = 'معطلة';
            }
        }
    });
}
</script>
@endsection
