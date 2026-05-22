<?php

namespace App\Filament\Resources\Padrons\Pages;

use App\Filament\Resources\Padrons\PadronResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPadron extends EditRecord
{
    protected static string $resource = PadronResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
