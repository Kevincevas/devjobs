<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Título Vacante')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="titulo" 
            :value="old('titulo')"
            placeholder="Título Vacante"
        />
        {{-- <x-input-error :messages="$errors->get('titulo')" class="mt-2" /> --}}
        @error('titulo')
            {{-- pasando el valor de message dinamicamente --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select wire:model="salario" id="salario" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">--Seleccione--</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{$salario->salario}}</option>
            @endforeach
        </select>
        {{-- <x-input-error :messages="$errors->get('salario')" class="mt-2" /> --}}
        @error('salario')
            {{-- pasando el valor de message dinamicamente --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select wire:model="categoria" id="categoria" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">--Seleccione--</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{$categoria->categoria}}</option>
            @endforeach
        </select>
        {{-- <x-input-error :messages="$errors->get('categoria')" class="mt-2" /> --}}
        @error('categoria')
            {{-- pasando el valor de message dinamicamente --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            id="empresa" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="empresa" 
            :value="old('empresa')"
            placeholder="Empresa: ej. Netflix, Uber, Shopify"
        />
        {{-- <x-input-error :messages="$errors->get('empresa')" class="mt-2" /> --}}
        @error('empresa')
            {{-- pasando el valor de message dinamicamente --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
        <x-text-input 
            id="ultimo_dia" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="ultimo_dia" 
            :value="old('ultimo_dia')"
        />
        {{-- <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" /> --}}
        @error('ultimo_dia')
            {{-- pasando el valor de message dinamicamente --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Descripción Puesto')" />
        <textarea
            wire:model="descripcion"
            placeholder="Descripción general del puesto"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-72"
        ></textarea>
        {{-- <x-input-error :messages="$errors->get('descripcion')" class="mt-2" /> --}}
        @error('descripcion')
            {{-- pasando el valor de message dinamicamente --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            id="imagen"
            class="block mt-1 w-full"
            type="file"
            wire:model="imagen_nueva"
            accept="image/*"
        />

        <div class="my-5 w-80">
            <x-input-label for="imagen" :value="__('Imagen Actual')" />

            {{-- se creo un link simbologico entre public/storage y storage/app/public, ya aparece la imagen --}}
            <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen Vacante ' . $titulo }}">

        </div>

        {{-- Imagen Preview --}}
        <div class="my-5 w-80">
            @if ($imagen_nueva)
                Previsualizando la Nueva Imagen:
                    <img src="{{ $imagen_nueva->temporaryUrl() }}">
            @endif
        </div>

        {{-- <x-input-error :messages="$errors->get('imagen')" class="mt-2" /> --}}
        @error('imagen_nueva')
            {{-- pasando el valor de message dinamicamente --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <x-primary-button>
        Guardar Cambios
    </x-primary-button>

</form>