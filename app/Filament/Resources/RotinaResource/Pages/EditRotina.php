<?php

namespace App\Filament\Resources\RotinaResource\Pages;

use App\Filament\Resources\RotinaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRotina extends EditRecord
{
    protected static string $resource = RotinaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
