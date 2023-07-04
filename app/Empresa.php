<?php

namespace topicoBuscador;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table='empresa';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'direccion',
    	'url',
        'idRubro',
        'latitud',
        'longitud'
    ];

    protected $guarded =[

    ];
}
