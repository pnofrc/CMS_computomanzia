<?php

namespace App\Filament\Resources\BigioResource\Pages;

use App\Filament\Resources\BigioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBigios extends ListRecords
{
    protected static string $resource = BigioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
