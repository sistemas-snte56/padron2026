<?php

namespace App\Filament\Resources\Padrons\Pages;

use App\Filament\Resources\Padrons\PadronResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPadron extends ViewRecord
{
    protected static string $resource = PadronResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
