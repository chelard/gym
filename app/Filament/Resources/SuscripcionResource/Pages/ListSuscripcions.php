<?php

namespace App\Filament\Resources\SuscripcionResource\Pages;

use App\Filament\Resources\SuscripcionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuscripcions extends ListRecords
{
    protected static string $resource = SuscripcionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
