# وثيقة التوثيق الهندسي الشامل لمنصة "أنجز" (Anjez Platform)
### *"المكان الصحيح لإنجاز أعمالك"*

تم إعداد هذا التوثيق ليكون مرجعاً تقنياً شاملاً ومفصلاً لأي مطور برمجيات أو مصمم واجهات يرغب في فهم، صيانة، وتطوير المنصة مستقبلاً.

---

## 1. نظرة عامة على المشروع (Project Overview)

منصة **"أنجز"** هي منصة رقمية متخصصة في تقديم الخدمات الأكاديمية والمهنية والتصميمية للطلاب والباحثين ورواد الأعمال. 
تتكون المنصة من:
1. **صفحة هبوط رئيسية (Single-Page Landing Page)**: فائقة السرعة والتفاعل، تعرض الخدمات والنماذج مع إمكانية التصفية الفورية والتكبير وطلب الخدمة عبر الواتساب بنقرة واحدة.
2. **لوحة تحكم للإدارة (Admin Dashboard)**: تتيح إدارة الخدمات الـ 6، رفع وتعديل عينات الأعمال في المعرض، والتحكم برقم الواتساب والنصوص الترويجية للموقع.
3. **قاعدة بيانات علائقية (PostgreSQL 18)**: لتخزين ومعالجة كافة البيانات مع علاقات متينة وفهارس سريعة.

---

## 2. الهوية البصرية ونظام التصميم (Visual Identity & Design System)

تم استخراج الهوية البصرية بدقة من الشعار الرسمي لمنصة أنجز:

| العنصر | القيمة اللونية (Hex) | الاستخدام الهندسي في التصميم |
| :--- | :--- | :--- |
| **Deep Navy Blue** | `#0F3254` / `#132F4C` | اللون الأساسي (Primary): العناوين، النصوص ذات التباين العالي، شريط الهيدر، والفوتر. |
| **Vibrant Oceanic Cyan** | `#0284C7` إلى `#0EA5E9` | اللون التفاعلي والتمييز (Accent): الأزرار، التدرجات، حالات الـ Hover، وأيقونات الثقة. |
| **Soft Slate Ice** | `#F0F6FA` إلى `#F8FAFC` | لون الخلفية العامة (Background Tint) والسطوح الهادئة المريحة للعين. |
| **Pure White** | `#FFFFFF` | لون بطاقات الخدمات، معرض النماذج، والسطوح الحاوية للمحتوى. |

### القواعد الصارمة للتصميم (Design Constraints):
- **ممنوع منعاً باتاً**: استخدام ألوان الذكاء الاصطناعي النمطية (البنفسجي، الوردي الفاقع، تدرجات النيون الصاخبة، أو الثيمات الليلية الخيالية).
- **التوجيه (Direction)**: اتجاه اليمين إلى اليسار (`dir="rtl"`) مع دعم كامل للغة العربية.
- **الخطوط المعتمدة (Typography)**:
  - خط **Cairo** (أوزان: 400, 600, 700, 800, 900) للعناوين والنصوص الرئيسية.
  - خط **IBM Plex Sans Arabic** للنصوص الرقمية والمصطلحات.
- **الحواف والظلال**: زوايا ناعمة انسيابية (`rounded-2xl` و `rounded-3xl`)، حدود رقيقة (`border-slate-200`)، وظلال ناعمة غير مزعجة (`shadow-sm` و `shadow-card`).

---

## 3. بنية قاعدة البيانات (PostgreSQL Database Schema)

اسم قاعدة البيانات: `anjez`
خادم قاعدة البيانات: `PostgreSQL 18` على المنفذ `5432`

### أ. جدول الخدمات (`services`)
يحتوي على الخدمات الـ 6 الأساسية في المنصة:
```sql
CREATE TABLE services (
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
CREATE INDEX idx_services_active_order ON services (is_active, "order");
```

**الخدمات الـ 6 المعتمدة مسبقاً في المنصة**:
1. `إنشاء بحوث` (Slug: `research-creation`, Icon: `book-open`)
2. `تصميم دعوات` (Slug: `invitations-design`, Icon: `mail`)
3. `تصميم سيرة ذاتية (CV)` (Slug: `cv-resume-design`, Icon: `file-text`)
4. `إنشاء Cover letter` (Slug: `cover-letter-creation`, Icon: `send`)
5. `إنشاء مذكرات بشكل عام` (Slug: `study-memos-notes`, Icon: `layers`)
6. `إعداد دراسات جدوى` (Slug: `feasibility-studies`, Icon: `trending-up`)

---

### ب. جدول معرض النماذج والعينات (`portfolio_items`)
لتخزين العينات والصور المعروضة للزوار:
```sql
CREATE TABLE portfolio_items (
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
CREATE INDEX idx_portfolio_service_order ON portfolio_items (service_id, "order");
CREATE INDEX idx_portfolio_featured ON portfolio_items (is_featured);
```

---

### جـ. جدول إعدادات المنصة (`settings`)
تخزين الإعدادات الديناميكية مثل رقم الواتساب ونصوص الموقع:
```sql
CREATE TABLE settings (
    id BIGSERIAL PRIMARY KEY,
    key VARCHAR(255) UNIQUE NOT NULL,
    value TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
**المفاتيح الافتراضية**:
- `whatsapp_number`: رقم الواتساب المستقبل للطلبات (مثال: `+967770000000`).
- `hero_headline`: العنوان الرئيسي الترويجي.
- `hero_subheadline`: النص التوضيحي للخدمات.
- `about_text`: نبذة عن المنصة ومميزاتها.

---

### د. جدول المستخدمين والمدراء (`users`)
```sql
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
* **الحساب الافتراضي للمدير**:
  * البريد: `admin@anjez.com`
  * كلمة المرور: `password123` (أو `1`)

---

## 4. الهيكل البرمجي للمشروع ومسارات الملفات

المسار الرئيسي للمشروع: `d:\Asma\Anjez`
المسار المربوط بخادم XAMPP Apache: `C:\xampp\htdocs\anjez`

```text
d:\Asma\Anjez\
├── .env                                  # إعدادات البيئة وقاعدة بيانات PostgreSQL
├── composer.json                         # تبعيات Laravel 11/12 و FilamentPHP v3
├── index.php                             # الواجهة العامة المباشرة المتصلة بقاعدة البيانات
├── app\
│   ├── Database.php                      # فئة مساعدة للاتصال بـ PostgreSQL PDO
│   ├── Models\
│   │   ├── Service.php                   # نموذج الخدمة (hasMany PortfolioItems + Scopes)
│   │   ├── PortfolioItem.php             # نموذج العينة (belongsTo Service + Image URLs)
│   │   ├── Setting.php                   # نموذج الإعدادات (Getters/Setters ديناميكية)
│   │   └── User.php                      # نموذج توثيق المستخدمين
│   ├── Http\Controllers\
│   │   ├── LandingController.php         # متحكم صفحة الهبوط
│   │   └── Admin\
│   │       ├── AuthController.php        # تسجيل الدخول والخروج
│   │       ├── DashboardController.php   # إحصائيات لوحة التحكم
│   │       ├── ServiceController.php     # إدارة الخدمات (CRUD وتفعيل/تعطيل)
│   │       ├── PortfolioItemController.php# إدارة النماذج ورفع الصور
│   │       └── SettingController.php     # تعديل الإعدادات والواتساب
│   └── Filament\                         # حزمة إدارة FilamentPHP v3
│       ├── Resources\
│       │   ├── ServiceResource.php       # إدارة الخدمات في Filament
│       │   └── PortfolioItemResource.php # إدارة النماذج في Filament
│       └── Pages\
│           └── ManageSettings.php        # صفحة الإعدادات في Filament
├── database\
│   ├── migrations\                       # ملفات الهجرة الرسمية لـ Laravel
│   │   ├── 2026_09_04_000000_create_users_table.php
│   │   ├── 2026_09_04_000001_create_services_table.php
│   │   ├── 2026_09_04_000002_create_portfolio_items_table.php
│   │   └── 2026_09_04_000003_create_settings_table.php
│   ├── seeders\                          # ملفات تعبئة البيانات الأولية
│   │   ├── DatabaseSeeder.php
│   │   ├── ServiceSeeder.php
│   │   └── SettingSeeder.php
│   └── schema_postgresql.sql             # سكريبت الـ SQL المنفذ مباشرة في PostgreSQL
├── resources\views\
│   ├── layouts\
│   │   ├── app.blade.php                 # القالب العام للموقع مع خط Cairo و Tailwind
│   │   ├── header.blade.php              # شريط التنقل العلوي والشعار
│   │   ├── footer.blade.php              # الفوتر وروابط التواصل
│   │   ├── whatsapp-fab.blade.php        # زر الواتساب العائم (FAB)
│   │   └── admin.blade.php               # القالب العام للوحة التحكم
│   ├── landing.blade.php                 # صفحة الهبوط الكاملة
│   └── admin\                            # صفحات لوحة التحكم المباشرة
│       ├── login.blade.php
│       ├── dashboard.blade.php
│       ├── services\ (index, create, edit)
│       ├── portfolio\ (index, create, edit)
│       └── settings.blade.php
├── admin\
│   └── index.php                         # لوحة الإدارة المتصلة فورياً بـ PostgreSQL
├── public\
│   └── images\
│       ├── logo.png                      # شعار منصة أنجز الرسمي
│       └── samples\                      # عينات الأعمال المصممة لكل خدمة:
│           ├── research_sample.jpg       # عينة إنشاء بحوث
│           ├── invitation_sample.jpg     # عينة تصميم دعوات
│           ├── cv_sample.jpg             # عينة سيرة ذاتية (CV)
│           ├── cover_letter_sample.jpg   # عينة Cover letter
│           ├── memo_sample.jpg           # عينة مذكرات دراسية
│           └── feasibility_sample.jpg    # عينة دراسة جدوى
└── routes\
    ├── web.php                           # مسارات الويب
    └── api.php                           # مسارات الـ API (JSON)
```

---

## 5. مكونات صفحة الهبوط التفاعلية (Landing Page Breakdown)

1. **شريط التنقل (Header)**:
   - يحتوي على شعار منصة "أنجز" الأصلي، ومؤشر نبض، وروابط التنقل السلس للأقسام، وزر "اطلب خدمتك الآن".
   - متوافق تماماً مع الهواتف الذكية بقائمة منسدلة عبر Alpine.js.
2. **قسم البطل (Hero Section)**:
   - العنوان الترويجي الرئيسي مع تدرج أنيق تحت كلمة "أنجز".
   - 3 مؤشرات ثقة واضحة:
     - ⚡ **سرعة تسليم فائقة** (التزام تام بالمواعيد).
     - 🎯 **احترافية ودقة متناهية** (بأيدي خبراء متخصصين).
     - 🔄 **مراجعات وتعديلات مجانية** (حتى الرضا التام).
   - زر تحويل رئيسي إلى الواتساب بنص ترحيبي مُعد تلقائياً.
   - بطاقة عرض بصرية تعرض الشعار الرسمي وإحصائيات الثقة (100% ضمان الجودة، +500 عمل منجز).
3. **شبكة الخدمات الـ 6 (Services Showcase)**:
   - تعرض الخدمات الـ 6 في بطاقات احترافية بتنسيق شبكي متجاوب.
   - لكل خدمة أيقونة خاصة، ورقم تسلسلي، ووصف موجز، وزر "اطلب هذه الخدمة" يفتح الواتساب مع كتابة اسم الخدمة تلقائياً.
4. **معرض النماذج التفاعلي (Samples Gallery)**:
   - **أزرار التصفية (Filter Tabs)**: مبنية باستخدام `Alpine.js` للتبديل الفوري بين أقسام الخدمات دون إعادة تحميل الصفحة.
   - **بطاقات المعرض**: صور عالية الدقة، شارة القسم، ومؤشر "نموذج مميز".
   - **عارض الصور المكبر (Lightbox Modal)**: عند النقر على أي عينة، تفتح نافذة تكبير منبثقة ناعمة تعرض الصورة بالحجم الكامل مع الوصف وزر مباشر لطلب عمل مماثل.
5. **آلية العمل (Order Process)**:
   - 3 خطوات مرئية ميسرة:
     1. اختر الخدمة وتصفح النماذج.
     2. أرسل التفاصيل عبر الواتساب.
     3. استلم عملك جاهزاً ومتقناً.
6. **لماذا أنجز؟ (Why Anjez)**:
   - بطاقات توضح مزايا السرية والخصوصية التامة، والأسعار المناسبة، والتوثيق المعتمد.
7. **زر الواتساب العائم (WhatsApp FAB)**:
   - مثبت في أسفل الشاشة مع دائرة نبض مضيئة وفقاعة ترحيبية تظهر عند التحويم.
8. **الفوتر (Footer)**:
   - يحتوي على النبذة التعريفية، الروابط السريعة، رقم الواتساب، ورابط الوصول لبوابة الإدارة.

---

## 6. كيفية تشغيل وتصفح المشروع (How to Run)

### الخيار الأول: عبر خادم XAMPP Apache المباشر (المُفعل حالياً):
تمت مزامنة الملفات في `C:\xampp\htdocs\anjez`، ويمكنك فتح الروابط التالية في المتصفح مباشرة:
- **الموقع الرئيسي**: [http://localhost/anjez/](http://localhost/anjez/)
- **لوحة التحكم**: [http://localhost/anjez/admin/](http://localhost/anjez/admin/)
  - البريد: `admin@anjez.com`
  - كلمة المرور: `password123` (أو `1`)

### الخيار الثاني: عبر خادم PHP المدمج:
من داخل المجلد `d:\Asma\Anjez`:
```powershell
cd d:\Asma\Anjez
php -S localhost:8000
```
ثم فتح المتصفح على: `http://localhost:8000`

### الخيار الثالث: عبر خادم Laravel Artisan:
```powershell
cd d:\Asma\Anjez
php artisan serve
```

---

## 7. دليل التعديل والتطوير لمن يأتي بعدي (Developer Extension Guide)

### أ. كيفية إضافة خدمة جديدة:
1. من خلال لوحة التحكم: الدخول إلى `http://localhost/anjez/admin/` -> التوجه لتبويب **إدارة الخدمات** -> الضغط على **إضافة خدمة جديدة**.
2. أو برمجياً عبر قاعدة البيانات PostgreSQL:
```sql
INSERT INTO services (title, slug, short_description, icon, "order", is_active)
VALUES ('عنوان الخدمة الجديدة', 'service-slug', 'الوصف المختصر...', 'briefcase', 7, TRUE);
```

### ب. كيفية إضافة نماذج وعينات جديدة للمعرض:
1. من خلال لوحة التحكم: الدخول لتبويب **معرض النماذج** -> ملء النموذج، اختيار الخدمة، ورفع الصورة (يُفضل نسبة 3:4).
2. سيتم حفظ الصورة في مجلد `public/images/samples/` وربطها تلقائياً بالمعرض ليراها الزوار فوراً.

### جـ. كيفية تغيير رقم الواتساب أو نصوص الواجهة:
1. من خلال لوحة التحكم: الدخول لتبويب **إعدادات الواتساب والموقع** -> تعديل الرقم (مع الرمز الدولي مثل `+967770000000`) وحفظ التعديلات.
2. ستتحدث كافة أزرار الطلب والزر العائم FAB فوراً على الصفحة الرئيسية دون الحاجة لتعديل الكود.

### د. كيفية إعادة تهيئة أو ترحيل قاعدة البيانات:
الملف `database/schema_postgresql.sql` يحتوي على كافة أوامر الـ DDL والـ Seeds. لتنفيذه في أي وقت:
```powershell
$env:PGPASSWORD='1'; & "C:\Program Files\PostgreSQL\18\bin\psql.exe" -U postgres -h 127.0.0.1 -p 5432 -d anjez -f "d:\Asma\Anjez\database\schema_postgresql.sql"
```

---

**تم بحمد الله وتوفيقه.**
منصة **"أنجز"** جاهزة تماماً للعمل والإنتاج بأعلى معايير الجودة والأداء.
