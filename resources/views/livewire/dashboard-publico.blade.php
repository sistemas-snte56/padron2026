<div class="min-h-screen bg-gray-50">
    {{-- ═══════════════ HEADER ═══════════════ --}}
    <header>
        <div class="bg-[#9d2449] flex items-center h-[80px] md:h-[90px]">

            {{-- Fondo blanco con el logo --}}
            <div class="bg-white flex items-center px-4 self-stretch">
                <img src="{{ asset('images/logosnte56@4x-8.png') }}"
                    alt="SNTE Sección 56 Veracruz"
                    class="h-14 md:h-16 w-auto">
            </div>

            {{-- Triángulo division.png --}}
            <img src="{{ asset('images/division@4x-8.png') }}"
                alt=""
                class="h-[80px] md:h-[90px] w-auto flex-shrink-0">

            {{-- Espacio central guinda --}}
            <div class="flex-1"></div>

            {{-- Logo La Unidad derecha --}}
            <div class="hidden md:flex items-center px-6 flex-shrink-0">
                <img src="{{ asset('images/logounidad@4x-8.png') }}"
                    alt="La Unidad - Nuestra Fortaleza"
                    class="h-14 w-auto">
            </div>

        </div>

        {{-- Franja naranja --}}
        <div class="bg-[#f18c21] h-3"></div>
    </header> 

    {{-- 2. CONTENIDO PRINCIPAL --}}
    <main class="max-w-7xl mx-auto px-6 py-10">

        {{-- FILA DE INDICADORES (KPIs) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white border border-[#1E2D45] border-l-4 border-l-blue-500 rounded-xl p-6 shadow-sm">
                <div class="text-lg font-bold text-gray-800 uppercase tracking-widest mb-2">Total Sedes</div>
                <div class="text-4xl font-bold text-blue-600 leading-none">{{ $total }}</div>
                <div class="text-[0.8rem] font-semibold text-gray-400 mt-2 italic">registros totales</div>
            </div>
            <div class="bg-white border border-[#1E2D45] border-l-4 border-l-orange-600 rounded-xl p-6 shadow-sm">
                <div class="text-lg font-bold text-gray-800 uppercase tracking-widest mb-2">Entregados</div>
                <div class="text-4xl font-bold text-orange-600 leading-none">{{ $entregados }}</div>
                <div class="text-[0.8rem] font-semibold text-gray-400 mt-2 italic">padrón completado</div>
            </div>
            <div class="bg-white border border-[#1E2D45] border-l-4 border-l-[#9d2449] rounded-xl p-6 shadow-sm">
                <div class="text-lg font-bold text-gray-800 uppercase tracking-widest mb-2">Pendientes</div>
                <div class="text-4xl font-bold text-[#9d2449] leading-none">{{ $pendientes }}</div>
                <div class="text-[0.8rem] font-semibold text-gray-400 mt-2 italic">por entregar</div>
            </div>
            <div class="bg-white border border-[#1E2D45] border-l-4 border-l-orange-500 rounded-xl p-6 shadow-sm">
                <div class="text-lg font-bold text-gray-800 uppercase tracking-widest mb-2">Avance</div>
                <div class="text-4xl font-bold text-orange-500 leading-none">{{ $porcentaje }}%</div>
                <div class="text-[0.8rem] font-semibold text-gray-400 mt-2 italic">eficiencia actual</div>
            </div>
        </div>

        {{-- SECCIÓN DE GRÁFICAS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white border border-[#1E2D45] rounded-xl p-6 flex flex-col h-[400px]">
                <h3 class="text-lg font-bold text-gray-800 uppercase tracking-widest mb-6 border-b pb-2">Distribución Global</h3>
                <div class="flex-grow relative">
                    <canvas id="canvasPastel"></canvas>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white border border-[#1E2D45] rounded-xl p-6 flex flex-col h-[400px]">
                <h3 class="text-lg font-bold text-gray-800 uppercase tracking-widest mb-6 border-b pb-2">Desempeño por Región</h3>
                <div class="flex-grow relative">
                    <canvas id="canvasRegion"></canvas>
                </div>
            </div>
        </div>

        {{-- FILTRO Y LISTADO --}}
        <div class="bg-white border border-[#1E2D45] rounded-xl p-6 shadow-sm">
            <div class="mb-6">
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Filtrar por Región</label>
                <select wire:model.live="regionSeleccionada" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                    <option value="">— Todas las regiones —</option>
                    @foreach ($regiones as $region)
                        <option value="{{ $region }}">{{ $region }}</option>
                    @endforeach
                </select>
            </div>

            @if(count($pendientesFiltrados) > 0)
                <div class="space-y-2">
                    <p class="text-[10px] font-bold text-[#9d2449] uppercase mb-3">Sedes con entrega pendiente:</p>
                    @foreach ($pendientesFiltrados as $item)
                        <div class="flex items-center justify-between p-3 bg-gray-50 border-l-4 border-[#9d2449] rounded-r-lg group hover:bg-red-50 transition-colors">
                            <span class="font-mono text-xs font-bold text-gray-700">{{ $item['delegacion'] }}</span>
                            <span class="text-xs text-gray-500 group-hover:text-gray-700">{{ $item['sede'] }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6">
                    <p class="text-xs text-gray-400 italic">No hay pendientes en esta selección.</p>
                </div>
            @endif
        </div>
    </main>

    {{-- ═══════════════ FOOTER ═══════════════ --}}
    <footer class="bg-[#9d2449]">
        <div class="bg-[#f18c21] h-3"></div>

        <div class="py-4 px-6 text-center">

            {{-- Logo La Unidad visible solo en móvil --}}
            <div class="flex justify-center mb-3 md:hidden">
                <img src="{{ asset('images/logounidad@4x-8.png') }}"
                    alt="La Unidad - Nuestra Fortaleza"
                    class="h-12 w-auto">
            </div>

            <p class="text-white text-sm">
                Sindicato Nacional de Trabajadores de la Educación &mdash; Sección 56 Veracruz
            </p>
            <p class="text-white/70 text-xs mt-1">
                &copy; {{ date('Y') }} Todos los derechos reservados
            </p>
        </div>
    </footer>    

    {{-- 3. SCRIPTS DE CONTROL --}}
<script>
    var instanceP = null;
    var instanceR = null;

    function initDashboard() {
        // 1. Limpieza total de instancias previas
        if (instanceP) { instanceP.destroy(); instanceP = null; }
        if (instanceR) { instanceR.destroy(); instanceR = null; }

        const ctxP = document.getElementById('canvasPastel');
        const ctxR = document.getElementById('canvasRegion');

        // 2. Gráfica de Pastel
        if (ctxP) {
            instanceP = new Chart(ctxP, {
                type: 'doughnut',
                data: {
                    labels: ['Entregado', 'Pendiente'],
                    datasets: [{
                        data: [{{ $entregados }}, {{ $pendientes }}],
                        backgroundColor: ['#ec660c', '#9d2449'],
                        borderWidth: 0
                    }]
                },
                options: { maintainAspectRatio: false, cutout: '70%', plugins: { legend: { display: false } } }
            });
        }

        // 3. Gráfica de Barras
        if (ctxR) {
            const rawData = @json($porRegion);
            instanceR = new Chart(ctxR, {
                type: 'bar',
                data: {
                    labels: rawData.map(r => r.region.replace('REGIÓN ', '').replace('REGION ', '')),
                    datasets: [{
                        label: 'Sedes Entregadas',
                        data: rawData.map(r => r.entregados),
                        backgroundColor: '#ec660c',
                        borderRadius: 4
                    }]
                },
                options: { 
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });
        }
    }

    // A. Carga inicial y navegación con Livewire SPA
    document.addEventListener('livewire:navigated', initDashboard);
    document.addEventListener('DOMContentLoaded', initDashboard);

    // B. ESTA ES LA CLAVE: Se ejecuta después de cada cambio en el componente (como el select)
    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('morph.updated', ({ component, el }) => {
            // Solo reiniciamos si el elemento que cambió contiene nuestras gráficas
            if (document.getElementById('canvasPastel') || document.getElementById('canvasRegion')) {
                initDashboard();
            }
        });
    });
</script>
</div>