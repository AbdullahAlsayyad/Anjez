<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds for default platform settings.
     */
    public function run(): void
    {
        $settings = [
            'whatsapp_number' => '+967770000000',
            'hero_headline'   => 'المكان الصحيح لإنجاز أعمالك الأكاديمية والمهنية',
            'hero_subheadline' => 'منصتكم المعتمدة لكتابة البحوث الجامعية، وتصميم السير الذاتية، وصياغة خطابات التقديم، وتصميم الدعوات الراقية، ودراسات الجدوى المتكاملة في وقت قياسي وبأعلى جودة.',
            'about_text'      => 'تأسست منصة "أنجز" لتكون الشريك الاستراتيجي لكل طالب، وباحث، وموظف، ورائد أعمال يسعى لتقديم عمل استثنائي يلفت الأنظار ويحقق الغاية المطلوبة بكل دقة واحتراف.',
            'site_name'       => 'منصة أنجز | Anjez Platform',
            'site_email'      => 'contact@anjez.com',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
