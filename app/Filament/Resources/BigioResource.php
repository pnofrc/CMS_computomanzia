<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BigioResource\Pages;
use App\Filament\Resources\BigioResource\RelationManagers;
use App\Models\Bigio;
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
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;

class BigioResource extends Resource
{
    protected static ?string $model = Bigio::class;

        public static function getPluralModelLabel(): string
    {
        return 'studiobigio.xyz';
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canAccess(): bool
     {
         return auth()->check() && in_array(auth()->user()->id, [1,3]);
     }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('title')
                ->default('Contenuti :)') 
                ->dehydrated(true) 
                ->required(),

                RichEditor::make('about')
                ->required(),
                

                Repeater::make('items')
                ->label('Contenuti')
                ->schema([
                    FileUpload::make('image')
                        ->label('Immagine')
                        ->directory(directory: 'storage')
                        ->saveUploadedFileUsing(function ($file) {
                            // $file è l'istanza del file caricato (solitamente un Livewire\TemporaryUploadedFile)
                            $tempPath = $file->getRealPath(); // Percorso temporaneo del file
                        
                            // Ridimensiona l'immagine al 35%
                            $command = "convert " . escapeshellarg($tempPath)
                                     . " -resize 35% " . escapeshellarg($tempPath);
                            exec($command);
                        
                            // Ottieni il nome del file (generato da hashName)
                            $fileName = $file->hashName();
                        
                            // Salva il file processato nel disco 'public'
                            Storage::disk('public')->put($fileName, file_get_contents($tempPath));
                        
                            // Elimina il file temporaneo
                            if (file_exists($tempPath)) {
                                unlink($tempPath);
                            }
                        
                            // Ritorna il nome del file che verrà salvato nel database
                            return $fileName;
                        })
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
            'index' => Pages\ListBigios::route('/'),
            'create' => Pages\CreateBigio::route('/create'),
            'edit' => Pages\EditBigio::route('/{record}/edit'),
        ];
    }
}
