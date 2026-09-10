<?php
/**
 * منصة أنجز (Anjez Platform) - لوحة تحكم الإدارة
 * متصلة بقاعدة بيانات PostgreSQL 18
 */
session_start();

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
} catch (PDOException $e) {
    die("تعذر الاتصال بقاعدة بيانات PostgreSQL: " . $e->getMessage());
}

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['admin_logged_in']);
    header('Location: index.php');
    exit;
}

// Handle Login
$loginError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === 'admin@anjez.com' && ($password === 'password123' || $password === '1')) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = 'مدير المنصة';
        header('Location: index.php');
        exit;
    } else {
        $loginError = 'البريد الإلكتروني أو كلمة المرور غير صحيحة.';
    }
}

// Check Authentication
$isLoggedIn = !empty($_SESSION['admin_logged_in']);

if (!$isLoggedIn):
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | لوحة تحكم منصة أنجز</title>
    <link rel="icon" type="image/png" href="../public/images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { 900: '#091E33', 800: '#0F3254', 700: '#132F4C' },
                        ocean: { 600: '#0284C7', 500: '#0EA5E9' }
                    },
                    fontFamily: { cairo: ['Cairo', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 font-['Cairo']">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 border border-slate-200 shadow-xl text-right">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-white border border-slate-200 shadow mx-auto p-1 mb-3 flex items-center justify-center">
                <img src="../public/images/logo.png" alt="أنجز" class="w-full h-full object-contain">
            </div>
            <h2 class="text-2xl font-black text-navy-800">لوحة تحكم منصة أنجز</h2>
            <p class="text-xs text-slate-500 font-semibold mt-1">المكان الصحيح لإنجاز أعمالك (PostgreSQL)</p>
        </div>

        <?php if ($loginError): ?>
        <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-bold">
            <?= htmlspecialchars($loginError) ?>
        </div>
        <?php endif; ?>

        <form action="index.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="login">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">البريد الإلكتروني</label>
                <input type="email" name="email" value="admin@anjez.com" required 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-ocean-500 text-sm font-medium outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">كلمة المرور</label>
                <input type="password" name="password" value="password123" required 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-ocean-500 text-sm font-medium outline-none">
            </div>
            <button type="submit" 
                    class="w-full py-3.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-sm shadow-md transition-colors mt-2">
                تسجيل الدخول إلى اللوحة
            </button>
        </form>
        <div class="mt-6 pt-6 border-t border-slate-100 text-center">
            <a href="../" class="text-xs text-ocean-600 hover:text-navy-800 font-bold">← العودة إلى الموقع الرئيسي</a>
        </div>
    </div>
</body>
</html>
<?php
exit;
endif;

// Handle CRUD Actions
$successMsg = '';

// Update Settings
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_settings') {
    $keys = ['whatsapp_number', 'hero_headline', 'hero_subheadline', 'about_text'];
    foreach ($keys as $key) {
        if (isset($_POST[$key])) {
            $stmt = $pdo->prepare('INSERT INTO settings (key, value, updated_at) VALUES (?, ?, NOW()) ON CONFLICT (key) DO UPDATE SET value = EXCLUDED.value, updated_at = NOW()');
            $stmt->execute([$key, $_POST[$key]]);
        }
    }
    $successMsg = 'تم حفظ إعدادات المنصة بنجاح في قاعدة البيانات.';
}

// Toggle Service Active
if (isset($_GET['action']) && $_GET['action'] === 'toggle_service' && isset($_GET['id'])) {
    $stmt = $pdo->prepare('UPDATE services SET is_active = NOT is_active WHERE id = ?');
    $stmt->execute([intval($_GET['id'])]);
    header('Location: index.php?tab=services');
    exit;
}

// Toggle Portfolio Featured
if (isset($_GET['action']) && $_GET['action'] === 'toggle_featured' && isset($_GET['id'])) {
    $stmt = $pdo->prepare('UPDATE portfolio_items SET is_featured = NOT is_featured WHERE id = ?');
    $stmt->execute([intval($_GET['id'])]);
    header('Location: index.php?tab=portfolio');
    exit;
}

// Add New Sample
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_sample') {
    $serviceId = intval($_POST['service_id']);
    $title = trim($_POST['title']);
    $desc = trim($_POST['description'] ?? '');
    $order = intval($_POST['order'] ?? 1);
    $featured = isset($_POST['is_featured']) ? 'TRUE' : 'FALSE';
    
    $imagePath = 'public/images/samples/cv_sample.jpg';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../public/images/samples/';
        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName);
        $imagePath = 'public/images/samples/' . $fileName;
    }

    $stmt = $pdo->prepare('INSERT INTO portfolio_items (service_id, title, description, image_path, is_featured, "order", created_at, updated_at) VALUES (?, ?, ?, ?, ' . $featured . ', ?, NOW(), NOW())');
    $stmt->execute([$serviceId, $title, $desc, $imagePath, $order]);
    $successMsg = 'تمت إضافة نموذج العمل بنجاح إلى المعرض.';
}

// Fetch Stats & Data
$totalServices = $pdo->query('SELECT COUNT(*) FROM services')->fetchColumn();
$activeServices = $pdo->query('SELECT COUNT(*) FROM services WHERE is_active = TRUE')->fetchColumn();
$totalSamples = $pdo->query('SELECT COUNT(*) FROM portfolio_items')->fetchColumn();
$featuredSamples = $pdo->query('SELECT COUNT(*) FROM portfolio_items WHERE is_featured = TRUE')->fetchColumn();

$services = $pdo->query('SELECT s.*, (SELECT COUNT(*) FROM portfolio_items p WHERE p.service_id = s.id) as samples_count FROM services s ORDER BY s."order" ASC, s.id ASC')->fetchAll();
$portfolioItems = $pdo->query('SELECT p.*, s.title as service_title FROM portfolio_items p JOIN services s ON p.service_id = s.id ORDER BY p."order" ASC, p.id DESC')->fetchAll();

$stmt = $pdo->query('SELECT key, value FROM settings');
$settings = [];
foreach ($stmt->fetchAll() as $row) {
    $settings[$row['key']] = $row['value'];
}

$currentTab = $_GET['tab'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم منصة أنجز</title>
    <link rel="icon" type="image/png" href="../public/images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { 900: '#091E33', 800: '#0F3254', 700: '#132F4C', 600: '#1B4268', 50: '#F0F6FA' },
                        ocean: { 600: '#0284C7', 500: '#0EA5E9', 50: '#F0F9FF' }
                    },
                    fontFamily: { cairo: ['Cairo', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-50 font-['Cairo'] flex text-slate-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-navy-900 text-slate-300 flex-shrink-0 hidden md:flex flex-col border-l border-navy-800">
        <div class="h-20 px-6 flex items-center gap-3 border-b border-navy-800">
            <div class="w-10 h-10 rounded-xl bg-white p-1 flex items-center justify-center">
                <img src="../public/images/logo.png" alt="أنجز" class="w-full h-full object-contain">
            </div>
            <div>
                <span class="text-xl font-black text-white">لوحة أنجز</span>
                <p class="text-[10px] text-ocean-400 font-semibold">PostgreSQL 18</p>
            </div>
        </div>

        <nav class="p-4 space-y-1.5 flex-grow font-semibold text-sm">
            <a href="index.php?tab=dashboard" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors <?= $currentTab === 'dashboard' ? 'bg-navy-800 text-white font-bold' : 'hover:bg-navy-800/60 text-slate-400 hover:text-white' ?>">
                <span>📊 الرئيسية والإحصائيات</span>
            </a>

            <a href="index.php?tab=services" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors <?= $currentTab === 'services' ? 'bg-navy-800 text-white font-bold' : 'hover:bg-navy-800/60 text-slate-400 hover:text-white' ?>">
                <span>📋 إدارة الخدمات (<?= count($services) ?>)</span>
            </a>

            <a href="index.php?tab=portfolio" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors <?= $currentTab === 'portfolio' ? 'bg-navy-800 text-white font-bold' : 'hover:bg-navy-800/60 text-slate-400 hover:text-white' ?>">
                <span>🖼️ معرض النماذج (<?= count($portfolioItems) ?>)</span>
            </a>

            <a href="index.php?tab=settings" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors <?= $currentTab === 'settings' ? 'bg-navy-800 text-white font-bold' : 'hover:bg-navy-800/60 text-slate-400 hover:text-white' ?>">
                <span>⚙️ إعدادات الواتساب والموقع</span>
            </a>
        </nav>

        <div class="p-4 border-t border-navy-800">
            <a href="../" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs transition-colors">
                <span>زيارة الموقع العام ↗</span>
            </a>
        </div>
    </aside>

    <!-- Main Container -->
    <div class="flex-grow flex flex-col min-w-0">
        <header class="h-20 bg-white border-b border-slate-200 px-6 flex items-center justify-between">
            <h1 class="text-xl font-bold text-navy-800">
                <?php
                if ($currentTab === 'services') echo 'إدارة الخدمات الـ 6';
                elseif ($currentTab === 'portfolio') echo 'معرض النماذج والعينات';
                elseif ($currentTab === 'settings') echo 'إعدادات المنصة ورقم الواتساب';
                else echo 'نظرة عامة وإحصائيات المنصة';
                ?>
            </h1>

            <div class="flex items-center gap-4">
                <span class="text-xs font-bold text-slate-500">مدير النظام</span>
                <a href="index.php?action=logout" class="px-3.5 py-1.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 hover:text-rose-600">
                    تسجيل الخروج
                </a>
            </div>
        </header>

        <?php if ($successMsg): ?>
        <div class="mx-6 mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold flex items-center gap-2">
            <span>✓ <?= htmlspecialchars($successMsg) ?></span>
        </div>
        <?php endif; ?>

        <main class="p-6 flex-grow">
            
            <!-- TAB 1: DASHBOARD -->
            <?php if ($currentTab === 'dashboard'): ?>
            <div class="space-y-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <span class="text-xs font-bold text-slate-500">إجمالي الخدمات المتاحة</span>
                        <div class="text-3xl font-black text-navy-800 mt-2"><?= $totalServices ?></div>
                        <span class="text-xs text-emerald-600 font-bold mt-1 inline-block"><?= $activeServices ?> خدمات مفعلة الآن</span>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <span class="text-xs font-bold text-slate-500">عينات ونماذج المعرض</span>
                        <div class="text-3xl font-black text-navy-800 mt-2"><?= $totalSamples ?></div>
                        <span class="text-xs text-ocean-600 font-bold mt-1 inline-block"><?= $featuredSamples ?> نماذج مميزة</span>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <span class="text-xs font-bold text-slate-500">رقم الواتساب النشط</span>
                        <div class="text-lg font-black text-navy-800 mt-2" dir="ltr"><?= htmlspecialchars($settings['whatsapp_number'] ?? '+967770000000') ?></div>
                        <span class="text-xs text-slate-400 font-medium mt-1 inline-block">يستقبل طلبات العملاء</span>
                    </div>

                    <div class="bg-gradient-to-br from-navy-800 to-navy-900 rounded-2xl p-6 text-white shadow-sm flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold text-ocean-300">قاعدة البيانات</span>
                            <h4 class="text-base font-black mt-1">PostgreSQL 18</h4>
                        </div>
                        <span class="text-xs text-emerald-400 font-bold">● متصل وجاهز</span>
                    </div>
                </div>

                <!-- Quick Services Overview -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-base text-navy-800 mb-4">الخدمات الأساسية في الموقع</h3>
                    <div class="divide-y divide-slate-100">
                        <?php foreach ($services as $srv): ?>
                        <div class="py-3 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 rounded-lg bg-slate-100 text-navy-800 font-bold text-xs flex items-center justify-center">
                                    <?= $srv['order'] ?>
                                </span>
                                <div>
                                    <span class="font-bold text-sm text-navy-800"><?= htmlspecialchars($srv['title']) ?></span>
                                    <span class="text-xs text-slate-400 block"><?= $srv['samples_count'] ?> نماذج معروضة</span>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold <?= $srv['is_active'] ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' ?>">
                                <?= $srv['is_active'] ? 'مفعلة' : 'معطلة' ?>
                            </span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- TAB 2: SERVICES -->
            <?php elseif ($currentTab === 'services'): ?>
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <table class="w-full text-right text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500">
                            <tr>
                                <th class="py-4 px-6">الترتيب</th>
                                <th class="py-4 px-6">اسم الخدمة</th>
                                <th class="py-4 px-6">الرابط (Slug)</th>
                                <th class="py-4 px-6">النماذج</th>
                                <th class="py-4 px-6">الحالة</th>
                                <th class="py-4 px-6 text-center">التحكم</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($services as $srv): ?>
                            <tr class="hover:bg-slate-50">
                                <td class="py-4 px-6 font-bold text-slate-600"><?= $srv['order'] ?></td>
                                <td class="py-4 px-6 font-bold text-navy-800"><?= htmlspecialchars($srv['title']) ?></td>
                                <td class="py-4 px-6 font-mono text-xs text-slate-500" dir="ltr"><?= htmlspecialchars($srv['slug']) ?></td>
                                <td class="py-4 px-6"><span class="px-2.5 py-1 rounded-full text-xs font-bold bg-ocean-50 text-ocean-700"><?= $srv['samples_count'] ?> نماذج</span></td>
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold <?= $srv['is_active'] ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' ?>">
                                        <?= $srv['is_active'] ? 'مفعلة' : 'معطلة' ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="index.php?tab=services&action=toggle_service&id=<?= $srv['id'] ?>" 
                                       class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-bold hover:bg-slate-100">
                                        <?= $srv['is_active'] ? 'تعطيل' : 'تفعيل' ?>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 3: PORTFOLIO -->
            <?php elseif ($currentTab === 'portfolio'): ?>
            <div class="space-y-6">
                <!-- Add Sample Form -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <h3 class="font-bold text-base text-navy-800 mb-4">+ إضافة نموذج عمل جديد</h3>
                    <form action="index.php?tab=portfolio" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="hidden" name="action" value="add_sample">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">الخدمة</label>
                            <select name="service_id" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none">
                                <?php foreach ($services as $srv): ?>
                                    <option value="<?= $srv['id'] ?>"><?= htmlspecialchars($srv['title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">عنوان النموذج</label>
                            <input type="text" name="title" required placeholder="مثال: نموذج سيرة ذاتية تنفيذية" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">صورة النموذج</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-600">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">الوصف</label>
                            <input type="text" name="description" placeholder="تفاصيل ومميزات النموذج..." class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none">
                        </div>
                        <div class="flex items-center gap-4 pt-4">
                            <label class="flex items-center gap-2 cursor-pointer text-xs font-bold">
                                <input type="checkbox" name="is_featured" value="1" checked class="rounded text-ocean-600">
                                <span>نموذج مميز</span>
                            </label>
                            <button type="submit" class="px-5 py-2 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs">
                                رفع وحفظ
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Existing Samples Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($portfolioItems as $pItem): ?>
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="relative aspect-[3/4] bg-slate-100 overflow-hidden">
                                <img src="../<?= htmlspecialchars($pItem['image_path']) ?>" alt="<?= htmlspecialchars($pItem['title']) ?>" class="w-full h-full object-cover">
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-white/95 text-navy-800 shadow">
                                        <?= htmlspecialchars($pItem['service_title']) ?>
                                    </span>
                                </div>
                                <?php if ($pItem['is_featured']): ?>
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-ocean-500 text-white shadow">مميز</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-sm text-navy-800"><?= htmlspecialchars($pItem['title']) ?></h4>
                                <p class="text-xs text-slate-500 mt-1 line-clamp-2"><?= htmlspecialchars($pItem['description']) ?></p>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <a href="index.php?tab=portfolio&action=toggle_featured&id=<?= $pItem['id'] ?>" class="font-bold text-ocean-600 hover:underline">
                                <?= $pItem['is_featured'] ? 'إلغاء التمييز' : 'تمييز كنموذج رئيسي' ?>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- TAB 4: SETTINGS -->
            <?php elseif ($currentTab === 'settings'): ?>
            <div class="max-w-2xl bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                <form action="index.php?tab=settings" method="POST" class="space-y-6">
                    <input type="hidden" name="action" value="update_settings">

                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-100">
                        <label class="block text-xs font-bold text-emerald-800 mb-1">رقم الواتساب الرئيسي لاستقبال الطلبات</label>
                        <input type="text" name="whatsapp_number" value="<?= htmlspecialchars($settings['whatsapp_number'] ?? '+967770000000') ?>" required dir="ltr"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-navy-800 outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">العنوان الترويجي الرئيسي (Hero Headline)</label>
                        <input type="text" name="hero_headline" value="<?= htmlspecialchars($settings['hero_headline'] ?? '') ?>" required 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">النص التوضيحي للخدمات (Hero Subheadline)</label>
                        <textarea name="hero_subheadline" rows="3" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm outline-none"><?= htmlspecialchars($settings['hero_subheadline'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">نبذة عن منصة أنجز (About Us)</label>
                        <textarea name="about_text" rows="4" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm outline-none"><?= htmlspecialchars($settings['about_text'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-navy-800 hover:bg-ocean-600 text-white font-bold text-xs shadow transition-colors">
                        حفظ الإعدادات في PostgreSQL
                    </button>
                </form>
            </div>
            <?php endif; ?>

        </main>
    </div>

</body>
</html>
