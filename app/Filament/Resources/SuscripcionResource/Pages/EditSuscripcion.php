<?php

namespace App\Filament\Resources\SuscripcionResource\Pages;

use App\Filament\Resources\SuscripcionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuscripcion extends EditRecord
{
    protected static string $resource = SuscripcionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
