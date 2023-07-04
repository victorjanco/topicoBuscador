<?php

namespace topicoBuscador;

use Illuminate\Database\Eloquent\Model;

class Clave extends Model
{
     protected $table='clave';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
    	'nombre'
    ];

    protected $guarded =[

    ];
}
