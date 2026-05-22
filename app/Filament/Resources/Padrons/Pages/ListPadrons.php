<?php

namespace App\Filament\Resources\Padrons\Pages;

use App\Filament\Resources\Padrons\PadronResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPadrons extends ListRecords
{
    protected static string $resource = PadronResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
