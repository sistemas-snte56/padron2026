<?php

namespace App\Livewire;

use App\Models\Padron;
use Livewire\Component;

class DashboardPublico extends Component
{
    public int $total        = 0;
    public int $entregados   = 0;
    public int $pendientes   = 0;
    public float $porcentaje = 0;
    public array $porRegion     = [];
    public array $porDelegacion = [];

    public string $regionSeleccionada = '';
    public array $pendientesFiltrados = [];
    public array $regiones = [];    

    public function mount(): void
    {
        $this->cargarDatos();

        $this->regiones = Padron::select('region')
            ->distinct()
            ->orderBy('region')
            ->pluck('region')
            ->toArray();
    }


    public function updatedRegionSeleccionada(): void
    {
        if ($this->regionSeleccionada === '') {
            $this->pendientesFiltrados = [];
            return;
        }

        $this->pendientesFiltrados = Padron::where('region', $this->regionSeleccionada)
            ->where('padron', false)
            ->orderBy('delegacion')
            ->get(['delegacion', 'nivel', 'sede'])
            ->toArray();
    }

    public function cargarDatos(): void
    {
        $this->total      = Padron::count();
        $this->entregados = Padron::where('padron', true)->count();
        $this->pendientes = Padron::where('padron', false)->count();
        $this->porcentaje = $this->total > 0
            ? round(($this->entregados / $this->total) * 100, 1)
            : 0;

        // Por región
        $this->porRegion = Padron::selectRaw('
                region,
                SUM(CASE WHEN padron = 1 THEN 1 ELSE 0 END) as entregados,
                SUM(CASE WHEN padron = 0 THEN 1 ELSE 0 END) as pendientes
            ')
            ->groupBy('region')
            ->orderBy('region')
            ->get()
            ->toArray();

        // Por delegación
        $this->porDelegacion = Padron::selectRaw('
                delegacion,
                SUM(CASE WHEN padron = 1 THEN 1 ELSE 0 END) as entregados,
                SUM(CASE WHEN padron = 0 THEN 1 ELSE 0 END) as pendientes
            ')
            ->groupBy('delegacion')
            ->orderBy('delegacion')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard-publico')
            ->layout('layouts.app');
    }
}