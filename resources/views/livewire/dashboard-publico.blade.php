<div>
    {{-- HEADER --}}
    <header style="background:#f5f5f5; border-bottom:2px solid #1E2D45; padding:1.5rem 2rem; display:flex; align-items:center; gap:1.2rem;">
        <div style="width:48px;height:48px;background:linear-gradient(135deg,#3D8EFF,#ec660c);border-radius:8px;display:flex;align-items:center;justify-content:center;font-family:'Montserrat',sans-serif;font-size:1.4rem;color:#fff;">
            PS
        </div>
        <div>
            <h1 style="font-family:'Montserrat',sans-serif;font-size:1.7rem;letter-spacing:0.06em;color:#ad9b49;line-height:1.1;">
                Padrón de Sedes — Estado de Entrega
            </h1>
            <p style="font-size:0.75rem;color:#6B7FA3;font-family:'IBM Plex Mono',monospace;letter-spacing:0.05em;">
                VERACRUZ
            </p>
        </div>
        <span style="margin-left:auto;display:flex;align-items:center;gap:6px;font-family:'IBM Plex Mono',monospace;font-size:0.7rem;color:#ec660c;">
            ● EN VIVO
        </span>
    </header>

    <main style="max-width:1100px;margin:0 auto;padding:2.5rem 1.5rem;">

        {{-- KPI TARJETAS --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem;margin-bottom:2rem;">
            <div style="background:#f5f5f5;border:1px solid #1E2D45;border-left:4px solid #3D8EFF;border-radius:12px;padding:1.4rem 1.6rem;">
                <div style="font-family:'IBM Plex Mono',monospace;font-size:0.65rem;letter-spacing:0.1em;color:#6B7FA3;margin-bottom:0.5rem;">TOTAL SEDES</div>
                <div style="font-family:'Montserrat',sans-serif;font-size:3rem;color:#3D8EFF;line-height:1;">{{ $total }}</div>
                <div style="font-size:0.72rem;color:#6B7FA3;">registros en sistema</div>
            </div>
            <div style="background:#f5f5f5;border:1px solid #1E2D45;border-left:4px solid #ec660c;border-radius:12px;padding:1.4rem 1.6rem;">
                <div style="font-family:'IBM Plex Mono',monospace;font-size:0.65rem;letter-spacing:0.1em;color:#6B7FA3;margin-bottom:0.5rem;">ENTREGADOS</div>
                <div style="font-family:'Montserrat',sans-serif;font-size:3rem;color:#ec660c;line-height:1;">{{ $entregados }}</div>
                <div style="font-size:0.72rem;color:#6B7FA3;">padrón completado</div>
            </div>
            <div style="background:#f5f5f5;border:1px solid #1E2D45;border-left:4px solid #9d2449;border-radius:12px;padding:1.4rem 1.6rem;">
                <div style="font-family:'IBM Plex Mono',monospace;font-size:0.65rem;letter-spacing:0.1em;color:#6B7FA3;margin-bottom:0.5rem;">PENDIENTES</div>
                <div style="font-family:'Montserrat',sans-serif;font-size:3rem;color:#9d2449;line-height:1;">{{ $pendientes }}</div>
                <div style="font-size:0.72rem;color:#6B7FA3;">sin entregar</div>
            </div>
            <div style="background:#f5f5f5;border:1px solid #1E2D45;border-left:4px solid #ec660c;border-radius:12px;padding:1.4rem 1.6rem;">
                <div style="font-family:'IBM Plex Mono',monospace;font-size:0.65rem;letter-spacing:0.1em;color:#6B7FA3;margin-bottom:0.5rem;">AVANCE</div>
                <div style="font-family:'Montserrat',sans-serif;font-size:3rem;color:#ec660c;line-height:1;">{{ $porcentaje }}%</div>
                <div style="font-size:0.72rem;color:#6B7FA3;">del total entregado</div>
            </div>
        </div> 

        {{-- FILA: PASTEL + REGIÓN --}}
        <div style="display:grid;grid-template-columns:1fr 2fr;gap:1.5rem;margin-bottom:2rem;">

            {{-- Gráfica pastel --}}
            <div style="background:#f5f5f5;border:1px solid #1E2D45;border-radius:12px;padding:1.8rem;">
                <div style="font-family:'Montserrat',sans-serif;font-weight:700;font-size:1.5em;letter-spacing:0.08em;color:#ee7a00;margin-bottom:1.4rem;padding-bottom:0.8rem;border-bottom:1px solid #1E2D45;">
                    DISTRIBUCIÓN DE ENTREGA
                </div>
                <div style="position:relative;max-width:220px;margin:0 auto;">
                    <canvas id="graficaPastel" width="220" height="220"></canvas>
                    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none;">
                        <div style="font-family:'Montserrat',sans-serif;font-size:2rem;color:#ec660c;line-height:1;">{{ $porcentaje }}%</div>
                        <div style="font-family:'IBM Plex Mono',monospace;font-size:0.6rem;color:#6B7FA3;letter-spacing:0.08em;">ENTREGADO</div>
                    </div>
                </div>
                <div style="display:flex;justify-content:center;gap:1.5rem;margin-top:1.2rem;">
                    <div style="display:flex;align-items:center;gap:0.4rem;font-size:0.8rem;color:#6B7FA3;">
                        <div style="width:10px;height:10px;border-radius:50%;background:#ec660c;"></div> Entregado
                    </div>
                    <div style="display:flex;align-items:center;gap:0.4rem;font-size:0.8rem;color:#6B7FA3;">
                        <div style="width:10px;height:10px;border-radius:50%;background:#9d2449;"></div> Pendiente
                    </div>
                </div>
            </div>

            {{-- Gráfica por región --}}
            <div style="background:#f5f5f5;border:1px solid #1E2D45;border-radius:12px;padding:1.8rem;">
                <div style="font-family:'Montserrat',sans-serif;font-weight:700;font-size:1.5em;letter-spacing:0.08em;color:#ee7a00;margin-bottom:1.4rem;padding-bottom:0.8rem;border-bottom:1px solid #1E2D45;">
                    ENTREGA POR REGIÓN
                </div>
                <canvas id="graficaRegion" height="180"></canvas>
            </div>

        </div>

        {{-- SELECTOR PENDIENTES POR REGIÓN --}}
        <div style="background:#f5f5f5;border:1px solid #1E2D45;border-radius:12px;padding:1.8rem;">
            <div style="font-family:'Montserrat',sans-serif;font-weight:700;font-size:1.5em;letter-spacing:0.08em;color:#ee7a00;margin-bottom:1.4rem;padding-bottom:0.8rem;border-bottom:1px solid #1E2D45;">
                DELEGACIONES PENDIENTES POR REGIÓN
            </div>

            <select wire:model.live="regionSeleccionada"
                style="width:100%;background:#FFFFFF;border:1px solid #1E2D45;border-radius:8px;padding:0.7rem 1rem;color:#000000;font-family:'IBM Plex Mono',monospace;font-size:0.8rem;margin-bottom:1.2rem;cursor:pointer;">
                <option value="">— Selecciona una región —</option>
                @foreach ($regiones as $region)
                    <option value="{{ $region }}">{{ $region }}</option>
                @endforeach
            </select>

            @if ($regionSeleccionada !== '' && count($pendientesFiltrados) === 0)
                <div style="text-align:center;padding:2rem;font-family:'IBM Plex Mono',monospace;font-size:0.8rem;color:#ec660c;">
                    ✓ Todas las delegaciones de esta región han entregado
                </div>
            @endif

            @if (count($pendientesFiltrados) > 0)
                <div style="font-family:'IBM Plex Mono',monospace;font-size:0.7rem;color:#9d2449;margin-bottom:0.8rem;letter-spacing:0.05em;">
                    {{ count($pendientesFiltrados) }} DELEGACIÓN(ES) PENDIENTE(S)
                </div>
                <div style="display:flex;flex-direction:column;gap:0.5rem;">
                    @foreach ($pendientesFiltrados as $item)
                        <div style="display:flex;align-items:center;gap:0.8rem;padding:0.7rem 1rem;background:#FFFFFF;border:1px solid #1E2D45;border-left:3px solid #9d2449;border-radius:8px;">
                            <span style="font-family:'IBM Plex Mono',monospace;font-size:0.75rem;color:#9d2449;font-weight:600;min-width:70px;">
                                {{ $item['delegacion'] }}
                            </span>
                            <span style="font-size:0.8rem;color:#6B7FA3;">
                                {{ $item['sede'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </main>

    <script>
        document.addEventListener('livewire:navigated', iniciar);
        document.addEventListener('DOMContentLoaded', iniciar);

        function iniciar() {
            const ctx = document.getElementById('graficaPastel');
            if (ctx) {
                new Chart(ctx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Entregado', 'Pendiente'],
                        datasets: [{
                            data: [{{ $entregados }}, {{ $pendientes }}],
                            backgroundColor: ['#ec660c', '#9d2449'],
                            borderColor: ['#FFFFFF', '#FFFFFF'],
                            borderWidth: 4,
                            hoverOffset: 8,
                        }],
                    },
                    options: {
                        cutout: '72%',
                        plugins: { legend: { display: false } },
                        animation: { animateRotate: true, duration: 1000 },
                    }
                });
            }

            const regionData = @json($porRegion);
            const ctxRegion = document.getElementById('graficaRegion');
            if (ctxRegion) {
                new Chart(ctxRegion.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: regionData.map(r => r.region.replace('REGIÓN ', '').replace('REGION ', '')),
                        datasets: [
                            {
                                label: 'Entregados',
                                data: regionData.map(r => r.entregados),
                                backgroundColor: '#ec660c',
                                borderRadius: 4,
                            },
                            {
                                label: 'Pendientes',
                                data: regionData.map(r => r.pendientes),
                                backgroundColor: '#9d2449',
                                borderRadius: 4,
                            }
                        ],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { labels: { color: '#6B7FA3', font: { family: 'IBM Plex Mono' } } }
                        },
                        scales: {
                            x: { ticks: { color: '#6B7FA3' }, grid: { color: '#1E2D45' } },
                            y: { ticks: { color: '#6B7FA3' }, grid: { color: '#1E2D45' } },
                        }
                    }
                });
            }
        }
    </script>
</div>