<footer class="bg-navy-900 text-slate-300 pt-16 pb-12 border-t border-navy-700/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
            
            <!-- Col 1: Brand Info -->
            <div class="md:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-white p-1 flex items-center justify-center shadow">
                        <img src="{{ asset('images/logo.png') }}" alt="أنجز" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="text-2xl font-black text-white">أنجز</span>
                        <p class="text-xs text-ocean-400 font-semibold">المكان الصحيح لإنجاز أعمالك</p>
                    </div>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed max-w-md">
                    {{ $settings['about_text'] ?? 'منصة متخصصة في تقديم أرقى الخدمات الأكاديمية والمهنية والتصميمية لطلاب الجامعات ورواد الأعمال، بدقة متناهية وسرعة فائقة.' }}
                </p>
                <div class="pt-2 flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-navy-800 text-ocean-300 border border-navy-700">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        متاحون لاستقبال طلباتكم على مدار الساعة
                    </span>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="text-white font-bold text-base mb-4 border-r-4 border-ocean-500 pr-3">روابط سريعة</h4>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li><a href="#hero" class="hover:text-ocean-400 transition-colors">الصفحة الرئيسية</a></li>
                    <li><a href="#services" class="hover:text-ocean-400 transition-colors">باقة الخدمات</a></li>
                    <li><a href="#samples" class="hover:text-ocean-400 transition-colors">نماذج وعينات الأعمال</a></li>
                    <li><a href="#process" class="hover:text-ocean-400 transition-colors">خطوات تقديم الطلب</a></li>
                    <li><a href="#about" class="hover:text-ocean-400 transition-colors">من نحن ومميزاتنا</a></li>
                </ul>
            </div>

            <!-- Col 3: Direct Contact -->
            <div>
                <h4 class="text-white font-bold text-base mb-4 border-r-4 border-ocean-500 pr-3">تواصل معنا فوراً</h4>
                <p class="text-xs text-slate-400 mb-3">للطلبات والاستفسارات المستعجلة، فريقنا مستعد للرد خلال دقائق:</p>
                <a href="{{ 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '967770000000') . '?text=' . urlencode('مرحباً منصة أنجز، أود الاستفسار عن الخدمات.') }}" 
                   target="_blank"
                   class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-300 border border-emerald-500/30 transition-all font-semibold text-sm w-full justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span dir="ltr">{{ $settings['whatsapp_number'] ?? '+967 770 000 000' }}</span>
                </a>
                <div class="mt-4 text-xs text-slate-500 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-ocean-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>سرعة استجابة فائقة خلال أوقات العمل</span>
                </div>
            </div>

        </div>

        <!-- Copyright Bar -->
        <div class="pt-8 border-t border-navy-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <p>© {{ date('Y') }} جميع الحقوق محفوظة لمنصة <strong class="text-white font-bold">أنجز</strong> - المكان الصحيح لإنجاز أعمالك.</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.login') }}" class="text-slate-500 hover:text-slate-300 transition-colors">بوابة الإدارة</a>
                <span class="text-slate-700">•</span>
                <span class="text-slate-400">صُمم وطُوّر بكل إتقان</span>
            </div>
        </div>
    </div>
</footer>
