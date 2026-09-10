<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds for the 6 core services and portfolio items.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'إنشاء بحوث',
                'slug' => 'research-creation',
                'short_description' => 'إعداد بحوث أكاديمية وتطبيقية متخصصة ومحكمة وفق أرقى المعايير العلمية والتوثيق الأكاديمي الدقيق (APA / MLA / Harvard).',
                'icon' => 'book-open',
                'order' => 1,
                'is_active' => true,
                'samples' => [
                    [
                        'title' => 'نموذج بحث علمي أكاديمي محكم',
                        'description' => 'إعداد متكامل يشمل خطة البحث، الدراسات السابقة، المنهجية، التحليل الإحصائي، وتوثيق المراجع.',
                        'image_path' => 'images/samples/research_sample.jpg',
                        'is_featured' => true,
                        'order' => 1,
                    ]
                ]
            ],
            [
                'title' => 'تصميم دعوات',
                'slug' => 'invitations-design',
                'short_description' => 'تصاميم دعوات فاخرة ورقمية للمناسبات الخاصة، حفلات الزفاف، والمؤتمرات الرسمية بلمسات خط عربي وأناقة راقية.',
                'icon' => 'mail',
                'order' => 2,
                'is_active' => true,
                'samples' => [
                    [
                        'title' => 'دعوة زفاف ومناسبات ملكية فاخرة',
                        'description' => 'تصميم خط عربي أصيل بدرجات كحلية وفيروزية مع بطاقة تفاصيل ومغلف رسمي.',
                        'image_path' => 'images/samples/invitation_sample.jpg',
                        'is_featured' => true,
                        'order' => 2,
                    ]
                ]
            ],
            [
                'title' => 'تصميم سيرة ذاتية (CV)',
                'slug' => 'cv-resume-design',
                'short_description' => 'صياغة وتصميم سير ذاتية احترافية عصرية باللغتين العربية والإنجليزية متوافقة تماماً مع أنظمة الفرز الآلي (ATS).',
                'icon' => 'file-text',
                'order' => 3,
                'is_active' => true,
                'samples' => [
                    [
                        'title' => 'سيرة ذاتية تنفيذية متوافقة مع ATS',
                        'description' => 'تنسيق عصري منظم يبرز المهارات والخبرات والإنجازات بلغة قوية وتصميم هادئ يشد الانتباه.',
                        'image_path' => 'images/samples/cv_sample.jpg',
                        'is_featured' => true,
                        'order' => 3,
                    ]
                ]
            ],
            [
                'title' => 'إنشاء Cover letter',
                'slug' => 'cover-letter-creation',
                'short_description' => 'كتابة خطابات تقديم وظيفية مخصصة ومقنعة تخاطب متطلبات الوظيفة الشاغرة وتظهر مدى ملائمة خبراتك للمنصب.',
                'icon' => 'send',
                'order' => 4,
                'is_active' => true,
                'samples' => [
                    [
                        'title' => 'خطاب تقديم وظيفي رسمي مقنع',
                        'description' => 'صياغة احترافية بأسلوب تسويق ذاتي يركز على القيمة المضافة لجهة التوظيف ومطابقة الشروط.',
                        'image_path' => 'images/samples/cover_letter_sample.jpg',
                        'is_featured' => true,
                        'order' => 4,
                    ]
                ]
            ],
            [
                'title' => 'إنشاء مذكرات بشكل عام',
                'slug' => 'study-memos-notes',
                'short_description' => 'تلخيص المناهج والمحاضرات وصياغة المذكرات الدراسية والتقارير التنفيذية بطريقة منسقة ومدعومة بالمخططات.',
                'icon' => 'layers',
                'order' => 5,
                'is_active' => true,
                'samples' => [
                    [
                        'title' => 'مذكرة دراسية شاملة وملخص تنفيذي',
                        'description' => 'ترتيب الأفكار الرئيسية، جداول المقارنة، والخرائط الذهنية لتسهيل المراجعة والاستيعاب السريع.',
                        'image_path' => 'images/samples/memo_sample.jpg',
                        'is_featured' => true,
                        'order' => 5,
                    ]
                ]
            ],
            [
                'title' => 'إعداد دراسات جدوى',
                'slug' => 'feasibility-studies',
                'short_description' => 'دراسات جدوى اقتصادية وتسويقية وفنية ومالية شاملة تدعم نجاح مشاريعكم وتلبي شروط جهات التمويل والدعم.',
                'icon' => 'trending-up',
                'order' => 6,
                'is_active' => true,
                'samples' => [
                    [
                        'title' => 'دراسة جدوى متكاملة وتحليل مالي',
                        'description' => 'توقعات التدفقات النقدية، فترة الاسترداد، تحليل نقطة التعادل، ومؤشرات الجدوى الاستثمارية.',
                        'image_path' => 'images/samples/feasibility_sample.jpg',
                        'is_featured' => true,
                        'order' => 6,
                    ]
                ]
            ],
        ];

        foreach ($services as $data) {
            $samples = $data['samples'] ?? [];
            unset($data['samples']);

            $service = Service::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            foreach ($samples as $sampleData) {
                PortfolioItem::updateOrCreate(
                    [
                        'service_id' => $service->id,
                        'title'      => $sampleData['title'],
                    ],
                    $sampleData
                );
            }
        }
    }
}
