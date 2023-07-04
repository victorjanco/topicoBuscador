<?php

namespace topicoBuscador;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    protected $table='rubro';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'descripcion'
    ];

    protected $guarded =[

    ];
}
