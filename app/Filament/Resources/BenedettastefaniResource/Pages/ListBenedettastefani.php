<?php

namespace App\Filament\Resources\BenedettastefaniResource\Pages;

use App\Filament\Resources\BenedettastefaniResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBenedettastefani extends ListRecords
{
    protected static string $resource = BenedettastefaniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
