<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the public single-page landing page.
     */
    public function index()
    {
        $services = Service::active()
            ->ordered()
            ->with(['portfolioItems' => function ($query) {
                $query->ordered();
            }])
            ->get();

        $portfolioItems = PortfolioItem::with('service')
            ->whereHas('service', function ($q) {
                $q->where('is_active', true);
            })
            ->ordered()
            ->get();

        $settings = [
            'whatsapp_number'  => Setting::get('whatsapp_number', '+967770000000'),
            'hero_headline'    => Setting::get('hero_headline', 'المكان الصحيح لإنجاز أعمالك الأكاديمية والمهنية'),
            'hero_subheadline' => Setting::get('hero_subheadline', 'منصة أنجز تقدم لك باقة متكاملة من الخدمات المتميزة: إعداد البحوث، تصميم السير الذاتية، دراسات الجدوى، وصياغة الخطابات الاحترافية بأعلى جودة وفي أسرع وقت.'),
            'about_text'       => Setting::get('about_text', 'فريق عمل متمرس يجمع بين الخبرة الأكاديمية العميقة والابتكار في التصميم لإخراج أعمالكم بأبهى صورة تعكس جديتكم واحترافكم.'),
        ];

        return view('landing', compact('services', 'portfolioItems', 'settings'));
    }
}
