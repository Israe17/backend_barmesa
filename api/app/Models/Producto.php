<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';//definimos el nombre de la tabla
    protected $fillable = ['nombre','descripcion','precio','image','idCategoria'];//definimos los campos que se pueden llenar


    public function categoria(){
        return $this->belongsTo('App\Models\Category','id');
    }



}
