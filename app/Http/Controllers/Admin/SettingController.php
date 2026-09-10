<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = [
            'whatsapp_number'  => Setting::get('whatsapp_number', '+967770000000'),
            'hero_headline'    => Setting::get('hero_headline', 'المكان الصحيح لإنجاز أعمالك الأكاديمية والمهنية'),
            'hero_subheadline' => Setting::get('hero_subheadline', 'منصة أنجز تقدم لك باقة متكاملة من الخدمات المتميزة: إعداد البحوث، تصميم السير الذاتية، دراسات الجدوى، وصياغة الخطابات الاحترافية بأعلى جودة وفي أسرع وقت.'),
            'about_text'       => Setting::get('about_text', 'فريق عمل متمرس يجمع بين الخبرة الأكاديمية العميقة والابتكار في التصميم لإخراج أعمالكم بأبهى صورة تعكس جديتكم واحترافكم.'),
            'site_name'        => Setting::get('site_name', 'منصة أنجز | Anjez'),
            'site_email'       => Setting::get('site_email', 'contact@anjez.com'),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'whatsapp_number'  => 'required|string|max:50',
            'hero_headline'    => 'required|string|max:255',
            'hero_subheadline' => 'required|string',
            'about_text'       => 'required|string',
            'site_name'        => 'nullable|string|max:255',
            'site_email'       => 'nullable|email|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'تم حفظ إعدادات المنصة بنجاح.');
    }
}
