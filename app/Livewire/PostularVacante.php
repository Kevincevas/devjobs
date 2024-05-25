<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{

    public $cv;
    public $vacante;

    // Habilitar la subida de archivos
    use WithFileUploads;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];


    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos = $this->validate();

        // Validar que el usuario no haya postulado ya a la vacante
        if($this->vacante->candidatos()->where('user_id', auth()->user()->id)->count() > 0) {
            // Crear el mensaje de error
            session()->flash('error', 'Ya postulaste a esta vacante anteriormente');
        } else {
            // almacenar el cv
            $cv = $this->cv->store('public/cv');
            // buscar y retirar ruta innecesaria para asignarle el nombre a la cv
            // $nombre_cv = str_replace('public/vacantes/', '', $cv);
            // dd($nombre_cv);
            $datos['cv'] = str_replace('public/cv/', '', $cv);


            // crear el candidato a la vacante
            $this->vacante->candidatos()->create([
                'user_id' => auth()->user()->id,
                'cv' => $datos['cv'],
            ]);

            // crear notificacion y enviar email
            $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id ));

            // mostrar al usuario un mensaje de ok
            session()->flash('mensaje', 'Se envió correctamente tu información, mucha suerte');
            return redirect()->back();
        }


    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
