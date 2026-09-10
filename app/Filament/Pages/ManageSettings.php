<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'إعدادات المنصة';

    protected static ?string $title = 'إعدادات المنصة وبيانات التواصل';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'whatsapp_number'  => Setting::get('whatsapp_number', '+967770000000'),
            'hero_headline'    => Setting::get('hero_headline', 'المكان الصحيح لإنجاز أعمالك'),
            'hero_subheadline' => Setting::get('hero_subheadline', 'منصة متكاملة لتقديم الخدمات الأكاديمية والتصميمية بأعلى درجات الاحتراف.'),
            'about_text'       => Setting::get('about_text', 'فريق متخصص يقدم أفضل النتائج لعملائنا في كل مهمة.'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات الاتصال المباشر')
                    ->schema([
                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('رقم الواتساب لاستقبال الطلبات (مع الرمز الدولي)')
                            ->helperText('مثال: +967770000000')
                            ->required(),
                    ]),

                Forms\Components\Section::make('النصوص الرئيسية للصفحة الهبوط (Hero Section)')
                    ->schema([
                        Forms\Components\TextInput::make('hero_headline')
                            ->label('العنوان الرئيسي الترويجي')
                            ->required(),

                        Forms\Components\Textarea::make('hero_subheadline')
                            ->label('النص التوضيحي للخدمات')
                            ->rows(3)
                            ->required(),

                        Forms\Components\Textarea::make('about_text')
                            ->label('نبذة عن منصة أنجز (About Us)')
                            ->rows(4)
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            Setting::set($key, $value);
        }

        Notification::make()
            ->title('تم حفظ الإعدادات بنجاح')
            ->success()
            ->send();
    }
}
