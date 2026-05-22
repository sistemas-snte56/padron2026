<?php

namespace App\Filament\Resources\Padrons\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PadronForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('region')
                    ->label('Región')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('delegacion')
                    ->label('Delegación')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nivel')
                    ->label('Nivel')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sede')
                    ->label('Sede')
                    ->required()
                    ->maxLength(255),
                Toggle::make('padron')
                    ->label('Padrón Entregado')
                    ->helperText('Activar cuando la sede haya entregado su padrón')
                    ->onColor('success')
                    ->offColor('danger'),
            ]);
    }
}