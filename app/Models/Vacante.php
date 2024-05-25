<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    // Definiendo como date el campo ultimo_dia ya que al consultar en la bd regresa como string y no como date
    protected $casts = ['ultimo_dia'=>'date'];


    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Creando las relaciones con las tablas de cateogria y salario
    public function categoria()
    {
        return $this->belongsTo(Categoria::class); //belongTo: pertenece a
    }
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }
    public function candidatos()
    {
        return $this->hasMany(Candidato::class)->orderBy('created_at','DESC'); //una vacante puede tener muchos candidatos
    }
    public function reclutador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
