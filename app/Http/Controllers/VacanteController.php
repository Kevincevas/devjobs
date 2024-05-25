<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // restringiendo poder visualizar las vaacntes solo a reclutadores mediante el policy, para que funcione el policy se añadio codigo a app/Http/Controllers/Controller.php
        $this->authorize('viewAny', Vacante::class);
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // restringiendo poder visualizar las vaacntes solo a reclutadores mediante el policy, para que funcione el policy se añadio codigo a app/Http/Controllers/Controller.php
        $this->authorize('create', Vacante::class);
        return view('vacantes.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', [
            'vacante' => $vacante,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {

        // if(!auth()->check())
        // {
        //     return redirect()->route( 'welcome' );
        // }
        // if(auth()->user()->id !== $vacante->user_id)
        // {
        //     return redirect()->route('vacantes.index');
        // }
        
        // return view('vacantes.edit', [
        //     'vacante' => $vacante
        // ]);


        // Usando el policy
        // $this->authorize('update', $vacante);
        // return view('vacantes.edit', [
        //     'vacante' => $vacante
        // ]);



        // Forma que funciono
        
        if (Gate::allows('update', $vacante)) {
            return view('vacantes.edit', [
                'vacante' => $vacante
            ]);
        }else{
            return redirect()->route('vacantes.index');
        }

    }

    
}
