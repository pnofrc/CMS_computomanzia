<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BenedettastefaniResource\Pages;
use App\Filament\Resources\BenedettastefaniResource\RelationManagers;
use App\Models\Benedettastefani;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Artisan;

class BenedettastefaniResource extends Resource
{

    public static function canCreate(): bool
    {
        return false;
    }


    public static function getPluralModelLabel(): string
    {
        return 'benedettastefani.it';
    }
    protected static ?string $model = Benedettastefani::class;

     public static function canAccess(): bool
     {
         return auth()->check() && in_array(auth()->user()->id, [1,2]);
     }

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('title')
                ->default('Contenuti :)') // Imposta un valore predefinito
                ->dehydrated(true) 
                ->required(),

                Repeater::make('items')
                ->label('Contenuti')
                ->schema([
                    FileUpload::make('image')
                        ->label('Immagine')
                        ->required(),

                    TextInput::make('title')
                        ->label('Titolo')
                        ->required(),

                    TextInput::make('text')
                        ->label('Testo')
                        ->required(),
                ])
                ->reorderable() 
                ->columnSpanFull(),
            ]);
    }


    public static function table(Table $table): Table
    {
         
        return $table
            ->columns([
                TextColumn::make('title')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('npm_build')
                    ->label('Esegui Build')
                    ->action(fn () => Artisan::call('npm:benedetta'))
                    ->successNotificationTitle('Build completata con successo!'),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListBenedettastefani::route('/'),
            // 'create' => Pages\CreateBenedettastefani::route('/create'),
            'edit' => Pages\EditBenedettastefani::route('/{record}/edit'),
        ];
    }
}
