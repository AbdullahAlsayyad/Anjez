<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول إلى لوحة التحكم | أنجز</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            900: '#091E33',
                            800: '#0F3254',
                            700: '#132F4C',
                        },
                        ocean: {
                            600: '#0284C7',
                            500: '#0EA5E9',
                        }
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 font-['Cairo']">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 border border-slate-200 shadow-xl text-right">
        
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-white border border-slate-200 shadow mx-auto p-1 mb-3 flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="أنجز" class="w-full h-full object-contain">
            </div>
            <h2 class="text-2xl font-black text-navy-800">منصة أنجز</h2>
            <p class="text-xs text-slate-500 font-semibold mt-1">بوابة الدخول إلى لوحة الإدارة والتحكم</p>
        </div>

        @if($errors->any())
        <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-bold">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email', 'admin@anjez.com') }}" required 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-ocean-500 focus:ring-2 focus:ring-ocean-100 text-sm font-medium outline-none transition-all">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5">كلمة المرور</label>
                <input type="password" id="password" name="password" value="password123" required 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-ocean-500 focus:ring-2 focus:ring-ocean-100 text-sm font-medium outline-none transition-all">
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600 font-medium">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-ocean-600 focus:ring-ocean-500">
                    <span>تذكرني على هذا الجهاز</span>
                </label>
            </div>

            <button type="submit" 
                    class="w-full py-3.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-sm shadow-md transition-all duration-200 mt-4">
                تسجيل الدخول
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-slate-100 text-center">
            <a href="{{ route('landing') }}" class="text-xs text-ocean-600 hover:text-navy-800 font-bold transition-colors">
                ← العودة إلى الموقع الرئيسي
            </a>
        </div>
    </div>
</body>
</html>
