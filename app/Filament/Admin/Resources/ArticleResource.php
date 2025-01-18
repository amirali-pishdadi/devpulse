<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ArticleResource\Pages;
use App\Filament\Admin\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Articles';
    protected static ?string $modelLabel = 'Article';
    protected static ?string $navigationGroup = 'Content Management';


    protected static ?string $recordTitleAttribute = 'title';

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->title;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'excerpt'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Title'  => $record->title,
            'Slug'   => $record->slug,
            'Status' => $record->status,

        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.username'),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('featured_image_url')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('reading_time')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('views_count')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('likes_count')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index'  => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create-article'),
            'view'   => Pages\ViewArticle::route('/{record}'),
            // 'edit'   => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
