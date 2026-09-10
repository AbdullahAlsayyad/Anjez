<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO & Social Meta Tags -->
    <title>أنجز | المكان الصحيح لإنجاز أعمالك الأكاديمية والمهنية</title>
    <meta name="description" content="منصة أنجز تقدم خدمات متكاملة واحترافية: كتابة بحوث، تصميم سير ذاتية CV، خطابات تقديم Cover Letter، تصميم دعوات فاخرة، وإعداد دراسات جدوى.">
    <meta name="keywords" content="أنجز, بحوث, سيرة ذاتية, CV, دعوات, دراسة جدوى, كفر ليتر, مذكرات, خدمات طلابية, خدمات مهنية">
    <meta property="og:title" content="أنجز - المكان الصحيح لإنجاز أعمالك">
    <meta property="og:description" content="جودة استثنائية وسرعة تسليم في كافة الأعمال الأكاديمية والتصميمية والمهنية.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Cairo & IBM Plex Sans Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN with Custom Brand Theme -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
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
                        arabic: ['"IBM Plex Sans Arabic"', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(15, 50, 84, 0.06)',
                        'card': '0 10px 30px -4px rgba(15, 50, 84, 0.08)',
                        'floating': '0 20px 40px -6px rgba(2, 132, 199, 0.25)',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js for High Performance Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #F0F6FA;
            color: #0F3254;
        }
        [x-cloak] { display: none !important; }
        
        /* Custom subtle scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F0F6FA;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #0284C7;
        }
        
        .hero-pattern {
            background-color: #F0F6FA;
            background-image: radial-gradient(#0284C7 0.75px, transparent 0.75px), radial-gradient(#0F3254 0.75px, #F0F6FA 0.75px);
            background-size: 30px 30px;
            background-position: 0 0, 15px 15px;
            background-opacity: 0.05;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-ocean-100 selection:text-navy-800">

    <!-- Global Navigation Header -->
    @include('layouts.header')

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Global Footer -->
    @include('layouts.footer')

    <!-- Floating Action Button (WhatsApp FAB) -->
    @include('layouts.whatsapp-fab')

    @stack('scripts')
</body>
</html>
