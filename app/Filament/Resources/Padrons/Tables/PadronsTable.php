<?php

namespace App\Filament\Resources\Padrons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\Action;
use App\Models\Padron;

class PadronsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('NP')
                    ->rowIndex(),
                TextColumn::make('region')
                    ->label('Región')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('delegacion')
                    ->label('Delegación / Nivel')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($record) =>
                        "{$record->delegacion}\n{$record->nivel}"
                    )
                    ->wrap(),

                TextColumn::make('sede')
                    ->label('Sede')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                IconColumn::make('padron')
                    ->label('Padrón')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('updated_at')
                    ->label('Última Modificación')
                    ->dateTime('d/m/Y h:i A')
                    ->timezone('America/Mexico_City')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                SelectFilter::make('region')
                    ->label('Región')
                    ->options(Padron::select('region')->distinct()->orderBy('region')->pluck('region', 'region'))
                    ->placeholder('Todas las regiones'),
                                
                TernaryFilter::make('padron')
                    ->label('Estado de Padrón')
                    ->trueLabel('Entregados')
                    ->falseLabel('Pendientes')
                    ->placeholder('Todos'),
            ])
            // CAMBIO 1: Se usa ->actions() para fijar los elementos como una columna al final
            ->actions([


                Action::make('togglePadron')
                    ->iconButton()
                    ->tooltip(fn (Padron $record) => $record->padron ? 'Quitar Padrón' : 'Marcar Entregado')
                    ->label(fn (Padron $record) => $record->padron ? 'Quitar Padrón' : 'Marcar Entregado')
                    ->icon(fn (Padron $record) => $record->padron ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn (Padron $record) => $record->padron ? 'danger' : 'success')
                    ->iconSize('xl')
                    
                    ->requiresConfirmation()
                    ->modalHeading('Actualizar Estado del Padrón')
                    ->modalSubmitActionLabel('Sí, confirmar cambio')

                    ->modalDescription(function (Padron $record) {
                        if ($record->padron) {
                            return "¿Estás seguro de revertir el estado? La delegación {$record->delegacion} volverá a quedar como PENDIENTE.";
                        }
                        
                        return "¿Confirmas que la delegación {$record->delegacion} ya entregó formalmente su padrón?";
                    })
                    
                    ->action(function (Padron $record) {
                        $record->update([
                            'padron' => ! $record->padron,
                        ]);
                    }),
                ViewAction::make()->iconButton(),
                EditAction::make()->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->paginationPageOptions([100, 150, 200])
            ->defaultPaginationPageOption(100)
            ->defaultSort('delegacion', 'asc');
    }
}