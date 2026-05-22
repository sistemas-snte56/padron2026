<?php

namespace App\Filament\Resources\Padrons\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PadronInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('region')
                    ->label('Región')
                    ->columnSpanFull(),
                TextEntry::make('delegacion')
                    ->label('Delegación'),
                TextEntry::make('nivel')
                    ->label('Nivel'),
                TextEntry::make('sede')
                    ->label('Sede'),
                IconEntry::make('padron')
                    ->label('Padrón Entregado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextEntry::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Última actualización')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
            ]);
    }
}