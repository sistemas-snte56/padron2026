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
                    ->label('Delegación')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nivel')
                    ->label('Nivel')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('sede')
                    ->label('Sede')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('padron')
                    ->label('Padrón')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('updated_at')
                    ->label('Última Modificación')
                    ->dateTime('d/m/Y h:i A') // Formato legible: Ej. 22/05/2026 11:00 AM
                    ->timezone('America/Mexico_City') // Ajusta a tu zona horaria si es necesario
                    ->sortable() // Permite ordenar de más antiguos a más recientes
                    ->toggleable(isToggledHiddenByDefault: false), // Permite al usuario ocultarla/mostrarla si quiere
                                        
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
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('togglePadron')
                    ->label(fn (Padron $record) => $record->padron ? 'Quitar' : 'Entregar')
                    ->icon(fn (Padron $record) => $record->padron ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn (Padron $record) => $record->padron ? 'danger' : 'success')
                    ->action(fn (Padron $record) => $record->update(['padron' => !$record->padron]))
                    ->requiresConfirmation(fn (Padron $record) => !$record->padron)
                    ->modalHeading('Confirmar acción')
                    ->modalDescription(fn (Padron $record) => "¿Confirmas que la delegación {$record->delegacion} aún no ha entregado su padrón?")
                    ->modalSubmitActionLabel('Sí, confirmar'),
                
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            // Configura las opciones del menú desplegable de paginación
            ->paginationPageOptions([100, 150, 200])
            
            // Define cuántos registros se muestran inmediatamente al cargar la página
            ->defaultPaginationPageOption(100)

            ->defaultSort('delegacion','asc');
    }
}