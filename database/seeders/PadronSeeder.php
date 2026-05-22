<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Padron;

class PadronSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/padron.csv');

        if (!file_exists($path)) {
            $this->command->warn('El archivo padron.csv no fue encontrado.');
            return;
        }

        $lineas = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Quitar BOM si existe
        $lineas[0] = preg_replace('/^\xEF\xBB\xBF/', '', $lineas[0]);

        // Saltar cabecera
        array_shift($lineas);

        foreach ($lineas as $linea) {
            $row = str_getcsv($linea);

            Padron::create([
                'region'     => trim($row[0]),
                'delegacion' => trim($row[1]),
                'nivel'      => trim($row[2]),
                'sede'       => trim($row[3]),
                'padron'     => (bool) trim($row[4]),
            ]);
        }

        $this->command->info('Padrón importado correctamente.');
    }
}