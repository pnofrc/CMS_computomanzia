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
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
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
                ->default('Contenuti :)') 
                ->dehydrated(true) 
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
                    
                            $maxSize = 700 * 1024; // 700 KB in byte
                            $resize = 95; // Qualità iniziale
                    
                            // Ciclo per ridurre la qualità finché la dimensione del file non è inferiore a 700 KB
                            while (filesize($tempPath) > $maxSize) {
                                // Usa ImageMagick per ridimensionare mantenendo l'aspect ratio
                                // "-resize 1920x1920\>" ridimensiona solo se l'immagine supera 1920px, mantenendo il rapporto
                                $command = "convert " . escapeshellarg($tempPath)
                                    . " -resize {$resize}% " . escapeshellarg($tempPath);
                                exec($command);

                                $resize -= 5;
                            }
                    
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
