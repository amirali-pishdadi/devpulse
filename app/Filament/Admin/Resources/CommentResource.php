<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CommentResource\Pages;
use App\Filament\Admin\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
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

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Comments';
    protected static ?string $modelLabel = 'Comment';
    protected static ?string $navigationGroup = 'User Feedback';

    protected static ?string $recordTitleAttribute = 'id';

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return 'Comment #' . $record->id;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['comment'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'User ID'    => $record->user_id,
            'Product ID' => $record->article_id ?? 'N/A',
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
                Select::make("article_id")
                    ->label("Article")
                    ->required()
                    ->preload()
                    ->searchable()
                    ->relationship(name: "article", titleAttribute: "title"),
                Select::make('user_id')
                    ->searchable()
                    ->label("User")
                    ->default(fn() => Auth::id())
                    ->preload()
                    ->relationship(name: "user", titleAttribute: "username")
                    ->required(),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_checked')
                    ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('article.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.username')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_checked')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('content')
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'view' => Pages\ViewComment::route('/{record}'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
