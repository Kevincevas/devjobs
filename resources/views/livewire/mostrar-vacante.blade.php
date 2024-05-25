<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3"> {{ $vacante->titulo }}</h3>

        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Empresa: <span class="normal-case font-normal">{{ $vacante->empresa }}</span> </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Último día para postularse: <span class="normal-case font-normal">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span> </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Categoría: <span class="normal-case font-normal">{{ $vacante->categoria->categoria }}</span> </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Salario: <span class="normal-case font-normal">{{ $vacante->salario->salario }}</span> </p>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4">
        <div class="md:col-span-3">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}" alt="{{ 'Imagen vacante' . $vacante->titulo }}">
        </div>

        <div class="md:col-span-3">
            <h2 class="text-2xl font-bold mb-5">Descripción del puesto</h2>
            <p>{{ $vacante->descripcion }}</p>
        </div>
    </div>

    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>
                ¿Desea aplicar a esta vacante? <a href="{{ route('register') }}" class="font-bold text-indigo-600">Obten una cuenta y aplica a esta y otras vacantes</a>
            </p>
        </div>
    @endguest

    {{-- usando la directiva @can mediante policy para mostrar informacion diferente dependiendo del rol del usuario --}}
    {{-- forma 1 --}}
    {{-- @can('create', App\Models\Vacante::class)
        <p>este es un reclutador</p>
    @else
        <livewire:postular-vacante />
    @endcan --}}

    {{-- forma 2, un poco mas limpia --}}
    @cannot('create', App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante" />
    @endcannot

</div>
