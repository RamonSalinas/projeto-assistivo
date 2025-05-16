<?php

namespace App\Filament\Resources\RotinaResource\Pages;

use App\Filament\Resources\RotinaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRotinas extends ListRecords
{
    protected static string $resource = RotinaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
