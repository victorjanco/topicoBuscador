<?php

namespace topicoBuscador;

use Illuminate\Database\Eloquent\Model;

class EmpresaClave extends Model
{
    protected $table='empresaclave';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
    	'idEmpresa',
    	'idClave'
    ];

    protected $guarded =[

    ];
}
