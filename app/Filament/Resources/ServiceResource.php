<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Service Content')
                    ->tabs([
                        Tabs\Tab::make('English')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Name (English)')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('short_description.en')
                                    ->label('Short Description (English)')
                                    ->required()
                                    ->maxLength(255)
                                    ->rows(3)
                                    ->helperText('Brief description that appears on the service card (max 255 characters)'),
                                RichEditor::make('description.en')
                                    ->label('Long Description (English)')
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike', 'bulletList', 'orderedList', 'link', 'blockquote', 'codeBlock', 'h2', 'h3', 'undo', 'redo'
                                    ])
                                    ->columnSpanFull()
                                    ->helperText('Detailed description that appears when user clicks "Read More"'),
                            ]),
                        Tabs\Tab::make('العربية')
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('الاسم (العربية)')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('short_description.ar')
                                    ->label('الوصف المختصر (العربية)')
                                    ->required()
                                    ->maxLength(255)
                                    ->rows(3)
                                    ->helperText('وصف مختصر يظهر على بطاقة الخدمة (الحد الأقصى 255 حرف)'),
                                RichEditor::make('description.ar')
                                    ->label('الوصف التفصيلي (العربية)')
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike', 'bulletList', 'orderedList', 'link', 'blockquote', 'codeBlock', 'h2', 'h3', 'undo', 'redo'
                                    ])
                                    ->columnSpanFull()
                                    ->helperText('وصف تفصيلي يظهر عند النقر على "اقرأ المزيد"'),
                            ]),
                    ])
                    ->columnSpanFull(),
                Section::make('General Settings')
                    ->schema([
                        TextInput::make('slug')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('URL-friendly identifier, auto-generated from name.'),
                        FileUpload::make('icon')
                            ->disk('public')
                            ->image()
                            ->maxSize(2048),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ViewColumn::make('icon')
                    ->label('Icon')
                    ->view('admin.columns.image')
                    ->getStateUsing(fn($record) => $record->icon),
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('short_description')->label('Short Description')->limit(40),
                Tables\Columns\TextColumn::make('created_at')->label('Created')->dateTime('M d, Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
