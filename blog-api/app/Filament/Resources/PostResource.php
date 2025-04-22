<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->maxLength(1000),
               
                Forms\Components\MultiSelect::make('categories')
                    ->relationship('categories', 'name')
                    ->preload()
                    ->label('Kategoriler'),
                Forms\Components\MultiSelect::make('tags')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->label('Etiketler'),
                 Forms\Components\FileUpload::make('image')
                    ->image(),    
               
                    Forms\Components\DateTimePicker::make('publish_at')
                    ->label('Başlangıç Tarihi')
                    ->default(now())
                    ->seconds(false)
                    ->timezone('Europe/Istanbul')
                    ->required(),
                    Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\DateTimePicker::make('expire_at')
                    ->label('Bitiş Tarihi')
                    ->seconds(false)
                    ->timezone('Europe/Istanbul')
                    ->required(),   
                   
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('İçerik')
                    ->searchable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('categories.name')->label('Kategoriler'),
                Tables\Columns\TextColumn::make('tags.name')->label('Etiketler'),   
                Tables\Columns\ImageColumn::make('image')->label('Resim'),
                Tables\Columns\IconColumn::make('status')
                    ->label('Durum')
                    ->boolean(),
                Tables\Columns\TextColumn::make('publish_at')->label('Başlangıç Tarihi'),
                Tables\Columns\TextColumn::make('expire_at')->label('Bitiş Tarihi'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
