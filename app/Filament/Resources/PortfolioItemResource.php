<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioItemResource\Pages;
use App\Models\PortfolioItem;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioItemResource extends Resource
{
    protected static ?string $model = PortfolioItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'معرض الأعمال والنماذج';

    protected static ?string $modelLabel = 'نموذج عمل';

    protected static ?string $pluralModelLabel = 'معرض الأعمال';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('بيانات نموذج العمل')
                    ->schema([
                        Forms\Components\Select::make('service_id')
                            ->label('الخدمة التابعة لها')
                            ->relationship('service', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->label('عنوان النموذج / العينة')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image_path')
                            ->label('صورة النموذج المعروض')
                            ->image()
                            ->directory('samples')
                            ->disk('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('3:4')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('1600')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('تمييز كنموذج رئيسي (Featured)')
                            ->default(false),

                        Forms\Components\Textarea::make('description')
                            ->label('تفاصيل ومميزات النموذج')
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
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('المعاينة')
                    ->square()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان النموذج')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('service.title')
                    ->label('الخدمة')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('الترتيب')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('service_id')
                    ->label('تصفية حسب الخدمة')
                    ->relationship('service', 'title'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('النماذج المميزة'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolioItems::route('/'),
            'create' => Pages\CreatePortfolioItem::route('/create'),
            'edit' => Pages\EditPortfolioItem::route('/{record}/edit'),
        ];
    }
}
