<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';//definimos el nombre de la tabla
    protected $fillable = ['cedula','nombre','apellido','correo','telefono','direccion'];//definimos los campos que se pueden llenar
}
