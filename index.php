<?php
/**
 * منصة أنجز (Anjez Platform) - الواجهة الرئيسية
 * "المكان الصحيح لإنجاز أعمالك"
 */

// 1. Establish PostgreSQL Database Connection
$dbHost = '127.0.0.1';
$dbPort = '5432';
$dbName = 'anjez';
$dbUser = 'postgres';
$dbPass = '1';

try {
    $pdo = new PDO("pgsql:host={$dbHost};port={$dbPort};dbname={$dbName}", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Fetch Active Services
    $stmt = $pdo->query('SELECT * FROM services WHERE is_active = TRUE ORDER BY "order" ASC, id ASC');
    $services = $stmt->fetchAll();

    // Fetch Portfolio Items with Service Titles
    $stmt = $pdo->query('SELECT p.*, s.title as service_title FROM portfolio_items p JOIN services s ON p.service_id = s.id WHERE s.is_active = TRUE ORDER BY p."order" ASC, p.id DESC');
    $portfolioItems = $stmt->fetchAll();

    // Fetch Settings
    $stmt = $pdo->query('SELECT key, value FROM settings');
    $rawSettings = $stmt->fetchAll();
    $settings = [];
    foreach ($rawSettings as $row) {
        $settings[$row['key']] = $row['value'];
    }

} catch (PDOException $e) {
    // Fallback seed data in case of unexpected DB disruption
    $services = [
        ['id' => 1, 'title' => 'إنشاء بحوث', 'slug' => 'research-creation', 'short_description' => 'إعداد بحوث أكاديمية وتطبيقية متخصصة ومحكمة وفق أرقى المعايير العلمية والتوثيق الأكاديمي الدقيق.', 'icon' => 'book-open', 'order' => 1],
        ['id' => 2, 'title' => 'تصميم دعوات', 'slug' => 'invitations-design', 'short_description' => 'تصاميم دعوات فاخرة ورقمية للمناسبات الخاصة، حفلات الزفاف، والمؤتمرات الرسمية بلمسات خط عربي وأناقة راقية.', 'icon' => 'mail', 'order' => 2],
        ['id' => 3, 'title' => 'تصميم سيرة ذاتية (CV)', 'slug' => 'cv-resume-design', 'short_description' => 'صياغة وتصميم سير ذاتية احترافية عصرية باللغتين العربية والإنجليزية متوافقة تماماً مع أنظمة الفرز الآلي (ATS).', 'icon' => 'file-text', 'order' => 3],
        ['id' => 4, 'title' => 'إنشاء Cover letter', 'slug' => 'cover-letter-creation', 'short_description' => 'كتابة خطابات تقديم وظيفية مخصصة ومقنعة تخاطب متطلبات الوظيفة الشاغرة وتظهر مدى ملائمة خبراتك للمنصب.', 'icon' => 'send', 'order' => 4],
        ['id' => 5, 'title' => 'إنشاء مذكرات بشكل عام', 'slug' => 'study-memos-notes', 'short_description' => 'تلخيص المناهج والمحاضرات وصياغة المذكرات الدراسية والتقارير التنفيذية بطريقة منسقة ومدعومة بالمخططات.', 'icon' => 'layers', 'order' => 5],
        ['id' => 6, 'title' => 'إعداد دراسات جدوى', 'slug' => 'feasibility-studies', 'short_description' => 'دراسات جدوى اقتصادية وتسويقية وفنية ومالية شاملة تدعم نجاح مشاريعكم وتلبي شروط جهات التمويل والدعم.', 'icon' => 'trending-up', 'order' => 6],
    ];

    $portfolioItems = [
        ['id' => 1, 'service_id' => 1, 'service_title' => 'إنشاء بحوث', 'title' => 'نموذج بحث علمي أكاديمي محكم', 'description' => 'إعداد متكامل يشمل خطة البحث، الدراسات السابقة، المنهجية، التحليل الإحصائي، وتوثيق المراجع.', 'image_path' => 'public/images/samples/research_sample.jpg', 'is_featured' => true],
        ['id' => 2, 'service_id' => 2, 'service_title' => 'تصميم دعوات', 'title' => 'دعوة زفاف ومناسبات ملكية فاخرة', 'description' => 'تصميم خط عربي أصيل بدرجات كحلية وفيروزية مع بطاقة تفاصيل ومغلف رسمي ومختوم.', 'image_path' => 'public/images/samples/invitation_sample.jpg', 'is_featured' => true],
        ['id' => 3, 'service_id' => 3, 'service_title' => 'تصميم سيرة ذاتية (CV)', 'title' => 'سيرة ذاتية تنفيذية متوافقة مع ATS', 'description' => 'تنسيق عصري منظم يبرز المهارات والخبرات والإنجازات بلغة قوية وتصميم هادئ يشد الانتباه.', 'image_path' => 'public/images/samples/cv_sample.jpg', 'is_featured' => true],
        ['id' => 4, 'service_id' => 4, 'service_title' => 'إنشاء Cover letter', 'title' => 'خطاب تقديم وظيفي رسمي مقنع', 'description' => 'صياغة احترافية بأسلوب تسويق ذاتي يركز على القيمة المضافة لجهة التوظيف ومطابقة الشروط.', 'image_path' => 'public/images/samples/cover_letter_sample.jpg', 'is_featured' => true],
        ['id' => 5, 'service_id' => 5, 'service_title' => 'إنشاء مذكرات بشكل عام', 'title' => 'مذكرة دراسية شاملة وملخص تنفيذي', 'description' => 'ترتيب الأفكار الرئيسية، جداول المقارنة، والخرائط الذهنية لتسهيل المراجعة والاستيعاب السريع.', 'image_path' => 'public/images/samples/memo_sample.jpg', 'is_featured' => true],
        ['id' => 6, 'service_id' => 6, 'service_title' => 'إعداد دراسات جدوى', 'title' => 'دراسة جدوى متكاملة وتحليل مالي', 'description' => 'توقعات التدفقات النقدية، فترة الاسترداد، تحليل نقطة التعادل، ومؤشرات الجدوى الاستثمارية.', 'image_path' => 'public/images/samples/feasibility_sample.jpg', 'is_featured' => true],
    ];

    $settings = [
        'whatsapp_number' => '+967770000000',
        'hero_headline'   => 'المكان الصحيح لإنجاز أعمالك الأكاديمية والمهنية',
        'hero_subheadline' => 'منصتكم الموثوقة لإعداد البحوث العلمية، وتصميم السير الذاتية، وصياغة خطابات التقديم، وتصميم الدعوات الراقية، وإعداد دراسات الجدوى المتكاملة في وقت قياسي وبأعلى جودة.',
        'about_text'      => 'تأسست منصة "أنجز" لتكون الشريك الاستراتيجي لكل طالب، وباحث، وموظف، ورائد أعمال يسعى لتقديم عمل استثنائي يلفت الأنظار ويحقق الغاية المطلوبة بكل دقة واحتراف.',
    ];
}

// Clean WhatsApp number
$whatsappRaw = $settings['whatsapp_number'] ?? '+967770000000';
$whatsappClean = preg_replace('/[^0-9]/', '', $whatsappRaw);
$whatsappBaseUrl = "https://wa.me/{$whatsappClean}?text=";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أنجز | المكان الصحيح لإنجاز أعمالك الأكاديمية والمهنية</title>
    <meta name="description" content="منصة أنجز تقدم خدمات متكاملة واحترافية: كتابة بحوث، تصميم سير ذاتية CV، خطابات تقديم Cover Letter، تصميم دعوات فاخرة، وإعداد دراسات جدوى.">
    
    <link rel="icon" type="image/png" href="public/images/hero_logo.png?v=2">

    <!-- Fonts: Cairo & IBM Plex Sans Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS with Strict Brand Palette -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            900: '#091E33',
                            800: '#0F3254', // Brand Primary Deep Navy
                            700: '#132F4C',
                            600: '#1B4268',
                            100: '#E6EFF7',
                            50: '#F0F6FA',  // Soft Slate Ice
                        },
                        ocean: {
                            700: '#0369A1',
                            600: '#0284C7', // Brand Oceanic Cyan
                            500: '#0EA5E9',
                            400: '#38BDF8',
                            100: '#E0F2FE',
                            50: '#F0F9FF',
                        },
                        slateice: '#F0F6FA',
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(15, 50, 84, 0.06)',
                        'card': '0 10px 30px -4px rgba(15, 50, 84, 0.08)',
                        'floating': '0 20px 40px -6px rgba(2, 132, 199, 0.28)',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #F0F6FA; color: #0F3254; }
        [x-cloak] { display: none !important; }
        .hero-pattern {
            background-color: #F0F6FA;
            background-image: radial-gradient(#0284C7 0.75px, transparent 0.75px), radial-gradient(#0F3254 0.75px, #F0F6FA 0.75px);
            background-size: 30px 30px;
            background-position: 0 0, 15px 15px;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-ocean-100 selection:text-navy-800">

    <!-- ==========================================
         NAVIGATION BAR
         ========================================== -->
    <header x-data="{ mobileOpen: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)" 
            :class="{ 'bg-white/90 backdrop-blur-md shadow-sm border-b border-slate-200/80': scrolled, 'bg-white/70 backdrop-blur-sm': !scrolled }" 
            class="sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo & Slogan -->
                <a href="#hero" class="flex items-center gap-3.5 group">
                    <div class="w-13 h-13 rounded-full bg-white p-0.5 border border-slate-200/90 shadow-sm flex items-center justify-center overflow-hidden transition-transform duration-300 group-hover:scale-105">
                        <img src="public/images/hero_logo.png?v=2" alt="شعار أنجز" class="w-11 h-11 object-contain">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1.5">
                            <span class="text-2xl font-black tracking-tight text-navy-800">أنجز</span>
                            <span class="inline-block w-2 h-2 rounded-full bg-ocean-500 animate-pulse"></span>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">المكان الصحيح لإنجاز أعمالك</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 font-semibold text-sm text-slate-700">
                    <a href="#hero" class="hover:text-ocean-600 transition-colors py-1">الرئيسية</a>
                    <a href="#services" class="hover:text-ocean-600 transition-colors py-1">خدماتنا</a>
                    <a href="#samples" class="hover:text-ocean-600 transition-colors py-1">معرض النماذج</a>
                    <a href="#process" class="hover:text-ocean-600 transition-colors py-1">كيف تبدأ؟</a>
                    <a href="#about" class="hover:text-ocean-600 transition-colors py-1">عن المنصة</a>
                </nav>

                <!-- CTA Order Button (Desktop) -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="<?= $whatsappBaseUrl . urlencode('مرحباً منصة أنجز، أود طلب خدمة جديدة.') ?>" 
                       target="_blank"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-navy-800 to-navy-700 hover:from-ocean-600 hover:to-ocean-500 text-white font-bold text-sm shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-emerald-400 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span>اطلب خدمتك الآن</span>
                    </a>
                </div>

                <!-- Mobile Menu Hamburger Button -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileOpen = !mobileOpen" 
                            type="button" 
                            class="p-2.5 rounded-xl text-navy-800 hover:bg-slate-100 transition-colors focus:outline-none">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Dropdown Navigation -->
        <div x-show="mobileOpen" 
             x-cloak
             class="md:hidden bg-white border-b border-slate-200 px-4 pt-3 pb-6 space-y-3 shadow-lg">
            <div class="flex items-center gap-3 pb-3 mb-1 border-b border-slate-100">
                <div class="w-12 h-12 rounded-full bg-white p-0.5 border border-slate-200 shadow-sm flex items-center justify-center overflow-hidden">
                    <img src="public/images/hero_logo.png?v=2" alt="شعار أنجز" class="w-10 h-10 object-contain">
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-black text-navy-800">منصة أنجز</span>
                    <span class="text-[11px] font-semibold text-slate-500">المكان الصحيح لإنجاز أعمالك</span>
                </div>
            </div>
            <a @click="mobileOpen = false" href="#hero" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">الرئيسية</a>
            <a @click="mobileOpen = false" href="#services" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">خدماتنا</a>
            <a @click="mobileOpen = false" href="#samples" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">معرض النماذج</a>
            <a @click="mobileOpen = false" href="#process" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">كيف تبدأ؟</a>
            <a @click="mobileOpen = false" href="#about" class="block px-3 py-2 rounded-lg font-bold text-navy-800 hover:bg-ocean-50 hover:text-ocean-600 transition-colors">عن المنصة</a>
            <div class="pt-2">
                <a href="<?= $whatsappBaseUrl . urlencode('مرحباً منصة أنجز، أود طلب خدمة جديدة.') ?>" 
                   target="_blank"
                   class="w-full flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-sm shadow-md transition-colors">
                    <span>تواصل عبر الواتساب</span>
                </a>
            </div>
        </div>
    </header>


    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section id="hero" class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28 hero-pattern">
        
        <div class="absolute top-1/4 right-1/2 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-ocean-100/60 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute top-1/3 left-10 w-72 h-72 bg-navy-100/40 rounded-full blur-2xl pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Hero Copy -->
                <div class="lg:col-span-7 text-center lg:text-right space-y-6">
                    
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm text-xs sm:text-sm font-bold text-navy-800">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-ocean-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-ocean-600"></span>
                        </span>
                        <span>المنصة الأولى المعتمدة لخدمات الطلاب ورواد الأعمال</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-navy-800 tracking-tight leading-tight sm:leading-none">
                        منصة <span class="text-ocean-600 relative inline-block">
                            أنجز
                            <svg class="absolute -bottom-2 right-0 w-full text-ocean-400/40" height="8" viewBox="0 0 200 8" fill="none" preserveAspectRatio="none">
                                <path d="M0 6C50 1 150 1 200 6" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <br class="hidden sm:inline">
                        <span class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-navy-700 mt-2 block">
                            <?= htmlspecialchars($settings['hero_headline'] ?? 'المكان الصحيح لإنجاز أعمالك') ?>
                        </span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        <?= htmlspecialchars($settings['hero_subheadline'] ?? 'منصتكم الموثوقة لإعداد البحوث العلمية، وتصميم السير الذاتية، وصياغة خطابات التقديم، وتصميم الدعوات الراقية، وإعداد دراسات الجدوى المتكاملة في وقت قياسي وبأعلى جودة.') ?>
                    </p>

                    <!-- Trust Indicators -->
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

                    <!-- Action CTAs -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="<?= $whatsappBaseUrl . urlencode('مرحباً منصة أنجز، أود الاستفسار وطلب عمل جديد.') ?>" 
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

                <!-- Hero Brand Showcase Card -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <div class="absolute -inset-2 rounded-3xl bg-gradient-to-tr from-ocean-500/20 via-navy-800/10 to-transparent blur-xl"></div>
                        <div class="relative rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/90 shadow-card">
                            
                            <div class="bg-gradient-to-b from-ocean-50/40 via-white to-white rounded-2xl p-6 border border-slate-100 flex flex-col items-center justify-center text-center">
                                <div class="relative w-48 h-48 sm:w-56 sm:h-56 mb-3 drop-shadow-md transition-transform duration-500 hover:scale-105 flex items-center justify-center">
                                    <img src="public/images/hero_logo.png" alt="أنجز - الشعار الرسمي" class="w-full h-full object-contain">
                                </div>
                                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-navy-800 text-white text-xs font-bold tracking-wide shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-ocean-400"></span>
                                    <span>المكان الصحيح لإنجاز أعمالك</span>
                                </div>
                            </div>

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
         SERVICES SHOWCASE (6 Core Offerings)
         ========================================== -->
    <section id="services" class="py-20 bg-white border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
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

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($services as $index => $service): ?>
                <div class="group relative rounded-2xl bg-white p-7 border border-slate-200 hover:border-ocean-300 shadow-sm hover:shadow-card transition-all duration-300 flex flex-col justify-between">
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-navy-800 to-navy-700 text-white flex items-center justify-center shadow-md group-hover:scale-105 group-hover:from-ocean-600 group-hover:to-ocean-500 transition-all duration-300">
                                <?php if ($service['icon'] === 'book-open'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <?php elseif ($service['icon'] === 'mail'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <?php elseif ($service['icon'] === 'file-text'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <?php elseif ($service['icon'] === 'send'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                <?php elseif ($service['icon'] === 'layers'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <?php elseif ($service['icon'] === 'trending-up'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                <?php elseif ($service['icon'] === 'briefcase'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <?php elseif ($service['icon'] === 'award'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                <?php elseif ($service['icon'] === 'edit'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                <?php elseif ($service['icon'] === 'check-circle'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <?php elseif ($service['icon'] === 'sparkles'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.286L13 21l-2.286-6.857L5 12l5.714-2.286L13 3z"/></svg>
                                <?php elseif ($service['icon'] === 'globe'): ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                <?php else: ?>
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <?php endif; ?>
                            </div>
                            <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2.5 py-1 rounded-md">
                                0<?= $index + 1 ?>
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-navy-800 group-hover:text-ocean-600 transition-colors mb-2.5">
                            <?= htmlspecialchars($service['title']) ?>
                        </h3>

                        <p class="text-sm text-slate-600 leading-relaxed">
                            <?= htmlspecialchars($service['short_description']) ?>
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between">
                        <a href="<?= $whatsappBaseUrl . urlencode('مرحباً منصة أنجز، أود الاستفسار وطلب خدمة: ' . $service['title']) ?>" 
                           target="_blank" 
                           class="inline-flex items-center gap-1.5 text-xs font-bold text-ocean-600 hover:text-navy-800 transition-colors">
                            <span>اطلب هذه الخدمة</span>
                            <svg class="w-4 h-4 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a href="#samples" class="text-xs text-slate-400 hover:text-ocean-600 font-medium transition-colors">
                            معاينة النماذج ←
                        </a>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>


    <!-- ==========================================
         SAMPLES GALLERY & LIGHTBOX (Alpine.js)
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

            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 mb-12">
                <button @click="activeFilter = 'all'"
                        :class="activeFilter === 'all' ? 'bg-navy-800 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200">
                    جميع النماذج
                </button>

                <?php foreach ($services as $service): ?>
                <button @click="activeFilter = 'service-<?= $service['id'] ?>'"
                        :class="activeFilter === 'service-<?= $service['id'] ?>' ? 'bg-navy-800 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200">
                    <?= htmlspecialchars($service['title']) ?>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Portfolio Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($portfolioItems as $item): ?>
                <div x-show="activeFilter === 'all' || activeFilter === 'service-<?= $item['service_id'] ?>'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-card transition-all duration-300 overflow-hidden flex flex-col">
                    
                    <div class="relative aspect-[3/4] bg-slate-100 overflow-hidden cursor-pointer"
                         @click="openLightbox({
                             title: '<?= addslashes($item['title']) ?>',
                             service: '<?= addslashes($item['service_title'] ?? 'خدمة أنجز') ?>',
                             description: '<?= addslashes($item['description'] ?? '') ?>',
                             image: '<?= htmlspecialchars($item['image_path']) ?>'
                         })">
                        
                        <img src="<?= htmlspecialchars($item['image_path']) ?>" 
                             alt="<?= htmlspecialchars($item['title']) ?>" 
                             loading="lazy"
                             class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">

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

                        <div class="absolute top-3 right-3">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-navy-800 backdrop-blur-sm shadow-sm border border-slate-200/60">
                                <?= htmlspecialchars($item['service_title'] ?? 'خدمة') ?>
                            </span>
                        </div>

                        <?php if (!empty($item['is_featured'])): ?>
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-ocean-500 text-white shadow-sm">
                                نموذج مميز
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div>
                            <h4 class="font-bold text-base text-navy-800 group-hover:text-ocean-600 transition-colors">
                                <?= htmlspecialchars($item['title']) ?>
                            </h4>
                            <?php if (!empty($item['description'])): ?>
                            <p class="text-xs text-slate-500 mt-1.5 line-clamp-2 leading-relaxed">
                                <?= htmlspecialchars($item['description']) ?>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <button type="button"
                                    @click="openLightbox({
                                        title: '<?= addslashes($item['title']) ?>',
                                        service: '<?= addslashes($item['service_title'] ?? 'خدمة أنجز') ?>',
                                        description: '<?= addslashes($item['description'] ?? '') ?>',
                                        image: '<?= htmlspecialchars($item['image_path']) ?>'
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
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Lightbox Modal Viewer -->
        <div x-show="lightboxOpen" 
             x-cloak
             @keydown.escape.window="closeLightbox()"
             class="fixed inset-0 z-50 overflow-y-auto"
             role="dialog" 
             aria-modal="true">
            
            <div class="fixed inset-0 bg-navy-900/80 backdrop-blur-sm transition-opacity" 
                 @click="closeLightbox()"></div>

            <div class="min-h-screen px-4 flex items-center justify-center p-4 text-center">
                <div x-show="lightboxOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                     class="relative bg-white rounded-3xl max-w-3xl w-full mx-auto overflow-hidden shadow-2xl border border-slate-200 text-right">
                    
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

                    <div class="p-6 bg-slate-100/60 max-h-[70vh] overflow-y-auto flex items-center justify-center">
                        <img :src="activeItem.image" 
                             :alt="activeItem.title"
                             class="max-w-full max-h-[60vh] object-contain rounded-xl shadow-md border border-slate-200/80">
                    </div>

                    <div class="px-6 py-4 bg-white border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <p class="text-xs text-slate-500 font-medium" x-text="activeItem.description || 'نموذج عمل حقيقي وموثق لمنصة أنجز.'"></p>
                        
                        <a :href="'<?= $whatsappBaseUrl ?>' + encodeURIComponent('مرحباً منصة أنجز، أود طلب عمل مماثل لنموذج: ' + activeItem.title)" 
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
         ORDER PROCESS (كيف تبدأ؟ - 3 خطوات)
         ========================================== -->
    <section id="process" class="py-20 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="relative bg-white rounded-2xl p-8 border border-slate-200/90 shadow-sm text-center hover:border-ocean-300 transition-all">
                    <div class="w-16 h-16 rounded-2xl bg-navy-800 text-white font-black text-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-navy-800 mb-2">اختر الخدمة وتصفح النماذج</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        حدد الخدمة التي تحتاجها من بين باقتنا واستعرض عينات الأعمال للتأكد من المعايير المناسبة لك.
                    </p>
                </div>

                <div class="relative bg-white rounded-2xl p-8 border border-slate-200/90 shadow-sm text-center hover:border-ocean-300 transition-all">
                    <div class="w-16 h-16 rounded-2xl bg-ocean-600 text-white font-black text-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-navy-800 mb-2">أرسل التفاصيل عبر الواتساب</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        تواصل معنا بضغطة زر، وزودنا بمتطلبات العمل والموعد النهائي المحدد، وسيقوم فريقنا بتأكيد التفاصيل فوراً.
                    </p>
                </div>

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

            <div class="mt-12 text-center">
                <a href="<?= $whatsappBaseUrl . urlencode('مرحباً منصة أنجز، أود بدء طلب عمل جديد.') ?>" 
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
                        <?= htmlspecialchars($settings['about_text'] ?? 'تأسست منصة أنجز لتكون الوجهة الموثوقة الأولى لكل من يبحث عن إتقان أعماله دون عناء. نحن نحرص على تقديم مخرجات تنافسية تلفت الأنظار وتلبي أعلى المعايير المهنية والأكاديمية.') ?>
                    </p>

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
                            <a href="<?= $whatsappBaseUrl . urlencode('مرحباً منصة أنجز، أود مناقشة تفاصيل طلبي.') ?>" 
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


    <!-- ==========================================
         FOOTER
         ========================================== -->
    <footer class="bg-navy-900 text-slate-300 pt-16 pb-12 border-t border-navy-700/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-white p-0.5 flex items-center justify-center shadow overflow-hidden">
                            <img src="public/images/hero_logo.png?v=2" alt="أنجز" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <span class="text-2xl font-black text-white">أنجز</span>
                            <p class="text-xs text-ocean-400 font-semibold">المكان الصحيح لإنجاز أعمالك</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-md">
                        <?= htmlspecialchars($settings['about_text'] ?? 'منصة متخصصة في تقديم أرقى الخدمات الأكاديمية والمهنية والتصميمية.') ?>
                    </p>
                    <div class="pt-2 flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-navy-800 text-ocean-300 border border-navy-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            متاحون لاستقبال طلباتكم على مدار الساعة
                        </span>
                    </div>
                </div>

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

                <div>
                    <h4 class="text-white font-bold text-base mb-4 border-r-4 border-ocean-500 pr-3">تواصل معنا فوراً</h4>
                    <p class="text-xs text-slate-400 mb-3">للطلبات والاستفسارات المستعجلة، فريقنا مستعد للرد خلال دقائق:</p>
                    <a href="<?= $whatsappBaseUrl . urlencode('مرحباً منصة أنجز، أود الاستفسار عن الخدمات.') ?>" 
                       target="_blank"
                       class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-300 border border-emerald-500/30 transition-all font-semibold text-sm w-full justify-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span dir="ltr"><?= htmlspecialchars($whatsappRaw) ?></span>
                    </a>
                </div>

            </div>

            <div class="pt-8 border-t border-navy-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>© <?= date('Y') ?> جميع الحقوق محفوظة لمنصة <strong class="text-white font-bold">أنجز</strong> - المكان الصحيح لإنجاز أعمالك.</p>
                <div class="flex items-center gap-4">
                    <a href="admin/" class="text-slate-500 hover:text-slate-300 transition-colors">بوابة الإدارة</a>
                    <span class="text-slate-700">•</span>
                    <span class="text-slate-400">متصل مباشرة بقاعدة PostgreSQL</span>
                </div>
            </div>
        </div>
    </footer>


    <!-- ==========================================
         FLOATING ACTION BUTTON (WhatsApp FAB)
         ========================================== -->
    <div x-data="{ hovered: false }" class="fixed bottom-6 left-6 z-50 flex items-center gap-3">
        <div x-show="hovered" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-x-4"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-4"
             class="hidden sm:block bg-navy-800 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-xl border border-navy-700 whitespace-nowrap">
            تحدث معنا مباشرة عبر الواتساب 👋
        </div>

        <a href="<?= $whatsappBaseUrl . urlencode('مرحباً منصة أنجز، أود الاستفسار وطلب خدمة.') ?>" 
           target="_blank"
           @mouseenter="hovered = true" 
           @mouseleave="hovered = false"
           aria-label="تواصل عبر الواتساب"
           class="relative group w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center shadow-floating transform hover:scale-110 active:scale-95 transition-all duration-300">
            <span class="absolute -inset-1 rounded-full bg-emerald-500/40 animate-ping"></span>
            <span class="absolute -inset-2 rounded-full bg-emerald-500/20"></span>
            <svg class="w-7 h-7 relative z-10 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
            </svg>
        </a>
    </div>

</body>
</html>
