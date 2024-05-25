<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{

    public $termino;
    public $categoria;
    public $salario;

    // escucha por 'terminosBusqueda' y cuando el evento ocurre manda a llamar 'buscar'
    protected $listeners = ['terminosBusqueda' => 'buscar'];


    // añadiendo los termino de busqueda desde FiltrarVacantes.php
    public function buscar($termino, $categoria, $salario)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;

    }

    public function render()
    {
        // $vacantes = Vacante::all();

        // when: se ejecuta cuando los valores tienen algo, si estan vacios no se ejecuta
        $vacantes = Vacante::when($this->termino, function($query){
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
        })
        // orWhere: si no encuentra el termino en el titulo, lo busca en la empresa
        ->when($this->termino, function($query){
            $query->orWhere('empresa', 'LIKE', "%" . $this->termino . "%");
        })
        ->when($this->categoria, function($query){
            $query->where('categoria_id', $this->categoria);
        })
        ->when($this->salario, function($query){
            $query->where('salario_id', $this->salario);
        })
        ->paginate(20);

        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes,
        ]);
    }
}
