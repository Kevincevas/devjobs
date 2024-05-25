<?php

namespace App\Livewire;

use App\Models\Vacante;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class MostrarVacantes extends Component
{
    // Forma 1 para conectar evento con una funcion, wire:click del boton ya no se le da un alias al parametro que se esta pasando
    protected $listeners = ['prueba','eliminarVacante'];

    // public function prueba($id)
    // {
    //     dd($id);
        
    // }

    public function eliminarVacante(Vacante $vacante)
    {

        // eliminando la imagen de la vacante del servidor
        Storage::delete('public/vacantes/' . $vacante->imagen);

        // eliminando la vacante
        $vacante->delete();
    }

    public function render()
    {
        // Consultadno las vacantes a la bd
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(2);

        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes,
        ]);
    }
}
