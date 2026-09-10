<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'الخدمات';

    protected static ?string $modelLabel = 'خدمة';

    protected static ?string $pluralModelLabel = 'الخدمات';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات الخدمة الأساسية')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان الخدمة')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                $operation === 'create' ? $set('slug', Str::slug($state, '-', null)) : null
                            ),

                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط المخصص (Slug)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('icon')
                            ->label('أيقونة الخدمة')
                            ->options([
                                'book-open'    => 'كتاب / بحوث (Book Open)',
                                'mail'         => 'دعوة / بريد (Mail)',
                                'file-text'    => 'سيرة ذاتية (File Text)',
                                'send'         => 'خطاب تقديم / إرسال (Send)',
                                'layers'       => 'مذكرات / طبقات (Layers)',
                                'trending-up'  => 'دراسات جدوى / نمو (Trending Up)',
                                'briefcase'    => 'أعمال مهنية (Briefcase)',
                                'award'        => 'تميز وجودة (Award)',
                            ])
                            ->default('file-text')
                            ->required(),

                        Forms\Components\TextInput::make('order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('مفعلة وتظهر في الموقع')
                            ->default(true)
                            ->required(),

                        Forms\Components\Textarea::make('short_description')
                            ->label('الوصف المختصر')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('الترتيب')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('slug')
                    ->label('الرابط')
                    ->color('gray')
                    ->limit(20),

                Tables\Columns\TextColumn::make('icon')
                    ->label('الأيقونة')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('portfolio_items_count')
                    ->label('عدد النماذج')
                    ->counts('portfolioItems')
                    ->badge()
                    ->color('success'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('الحالة')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('الحالة')
                    ->trueLabel('المفعلة فقط')
                    ->falseLabel('المعطلة فقط'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
