-- PostgreSQL Database Schema for Anjez Platform (منصة أنجز)

-- 1. Users Table
CREATE TABLE IF NOT EXISTS users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Services Table
CREATE TABLE IF NOT EXISTS services (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    short_description TEXT NOT NULL,
    icon VARCHAR(255) NOT NULL,
    "order" INTEGER DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_services_active_order ON services (is_active, "order");

-- 3. Portfolio Items (Samples Showcase Grid)
CREATE TABLE IF NOT EXISTS portfolio_items (
    id BIGSERIAL PRIMARY KEY,
    service_id BIGINT NOT NULL REFERENCES services(id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_featured BOOLEAN DEFAULT FALSE,
    "order" INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_portfolio_service_order ON portfolio_items (service_id, "order");
CREATE INDEX IF NOT EXISTS idx_portfolio_featured ON portfolio_items (is_featured);

-- 4. Settings Table
CREATE TABLE IF NOT EXISTS settings (
    id BIGSERIAL PRIMARY KEY,
    key VARCHAR(255) UNIQUE NOT NULL,
    value TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Seed Admin User (password: password123 with bcrypt hash)
INSERT INTO users (name, email, password, created_at, updated_at)
VALUES (
    'مدير المنصة',
    'admin@anjez.com',
    '$2y$12$RlmkC.G5w9h5TzG7yG9Zk.k5uG8d3x2A1b0C9d8e7f6g5h4j3k2l1',
    NOW(),
    NOW()
) ON CONFLICT (email) DO NOTHING;

-- 6. Seed the 6 Core Services
INSERT INTO services (id, title, slug, short_description, icon, "order", is_active, created_at, updated_at)
VALUES 
(1, 'إنشاء بحوث', 'research-creation', 'إعداد بحوث أكاديمية وتطبيقية متخصصة ومحكمة وفق أرقى المعايير العلمية والتوثيق الأكاديمي الدقيق (APA / MLA / Harvard).', 'book-open', 1, TRUE, NOW(), NOW()),
(2, 'تصميم دعوات', 'invitations-design', 'تصاميم دعوات فاخرة ورقمية للمناسبات الخاصة، حفلات الزفاف، والمؤتمرات الرسمية بلمسات خط عربي وأناقة راقية.', 'mail', 2, TRUE, NOW(), NOW()),
(3, 'تصميم سيرة ذاتية (CV)', 'cv-resume-design', 'صياغة وتصميم سير ذاتية احترافية عصرية باللغتين العربية والإنجليزية متوافقة تماماً مع أنظمة الفرز الآلي (ATS).', 'file-text', 3, TRUE, NOW(), NOW()),
(4, 'إنشاء Cover letter', 'cover-letter-creation', 'كتابة خطابات تقديم وظيفية مخصصة ومقنعة تخاطب متطلبات الوظيفة الشاغرة وتظهر مدى ملائمة خبراتك للمنصب.', 'send', 4, TRUE, NOW(), NOW()),
(5, 'إنشاء مذكرات بشكل عام', 'study-memos-notes', 'تلخيص المناهج والمحاضرات وصياغة المذكرات الدراسية والتقارير التنفيذية بطريقة منسقة ومدعومة بالمخططات.', 'layers', 5, TRUE, NOW(), NOW()),
(6, 'إعداد دراسات جدوى', 'feasibility-studies', 'دراسات جدوى اقتصادية وتسويقية وفنية ومالية شاملة تدعم نجاح مشاريعكم وتلبي شروط جهات التمويل والدعم.', 'trending-up', 6, TRUE, NOW(), NOW())
ON CONFLICT (slug) DO UPDATE SET 
    title = EXCLUDED.title,
    short_description = EXCLUDED.short_description,
    icon = EXCLUDED.icon,
    "order" = EXCLUDED."order",
    is_active = EXCLUDED.is_active;

-- 7. Seed Portfolio Showcase Samples
INSERT INTO portfolio_items (service_id, title, description, image_path, is_featured, "order", created_at, updated_at)
VALUES 
(1, 'نموذج بحث علمي أكاديمي محكم', 'إعداد متكامل يشمل خطة البحث، الدراسات السابقة، المنهجية، التحليل الإحصائي، وتوثيق المراجع.', 'images/samples/research_sample.jpg', TRUE, 1, NOW(), NOW()),
(2, 'دعوة زفاف ومناسبات ملكية فاخرة', 'تصميم خط عربي أصيل بدرجات كحلية وفيروزية مع بطاقة تفاصيل ومغلف رسمي ومختوم.', 'images/samples/invitation_sample.jpg', TRUE, 2, NOW(), NOW()),
(3, 'سيرة ذاتية تنفيذية متوافقة مع ATS', 'تنسيق عصري منظم يبرز المهارات والخبرات والإنجازات بلغة قوية وتصميم هادئ يشد الانتباه.', 'images/samples/cv_sample.jpg', TRUE, 3, NOW(), NOW()),
(4, 'خطاب تقديم وظيفي رسمي مقنع', 'صياغة احترافية بأسلوب تسويق ذاتي يركز على القيمة المضافة لجهة التوظيف ومطابقة الشروط.', 'images/samples/cover_letter_sample.jpg', TRUE, 4, NOW(), NOW()),
(5, 'مذكرة دراسية شاملة وملخص تنفيذي', 'ترتيب الأفكار الرئيسية، جداول المقارنة، والخرائط الذهنية لتسهيل المراجعة والاستيعاب السريع.', 'images/samples/memo_sample.jpg', TRUE, 5, NOW(), NOW()),
(6, 'دراسة جدوى متكاملة وتحليل مالي', 'توقعات التدفقات النقدية، فترة الاسترداد، تحليل نقطة التعادل، ومؤشرات الجدوى الاستثمارية.', 'images/samples/feasibility_sample.jpg', TRUE, 6, NOW(), NOW())
ON CONFLICT DO NOTHING;

-- 8. Seed Platform Settings
INSERT INTO settings (key, value, created_at, updated_at)
VALUES 
('whatsapp_number', '+967770000000', NOW(), NOW()),
('hero_headline', 'المكان الصحيح لإنجاز أعمالك الأكاديمية والمهنية', NOW(), NOW()),
('hero_subheadline', 'منصتكم الموثوقة لإعداد البحوث العلمية، وتصميم السير الذاتية، وصياغة خطابات التقديم، وتصميم الدعوات الراقية، وإعداد دراسات الجدوى المتكاملة في وقت قياسي وبأعلى جودة.', NOW(), NOW()),
('about_text', 'تأسست منصة "أنجز" لتكون الشريك الاستراتيجي لكل طالب، وباحث، وموظف، ورائد أعمال يسعى لتقديم عمل استثنائي يلفت الأنظار ويحقق الغاية المطلوبة بكل دقة واحتراف.', NOW(), NOW()),
('site_name', 'منصة أنجز | Anjez', NOW(), NOW()),
('site_email', 'contact@anjez.com', NOW(), NOW())
ON CONFLICT (key) DO UPDATE SET value = EXCLUDED.value;
