<?php

namespace topicoBuscador\Http\Controllers;

use Illuminate\Http\Request;

use topicoBuscador\Http\Requests;//ojo

use topicoBuscador\Clave;
use topicoBuscador\Empresa;
use topicoBuscador\EmpresaClave;
use Illuminate\Support\Facades\Redirect;
use topicoBuscador\Http\Requests\EmpresaFormRequest;
use DB;

use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
class EmpresaController extends Controller
{
     public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $empresas=DB::table('empresa')->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('vistas.empresa.index',["empresas"=>$empresas,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	$rubros=DB::table('rubro')->get();
        $claves=DB::table('clave')->get();
       
        return view("vistas.empresa.create",["rubros"=>$rubros,"claves"=>$claves]);
    }

    public function store(EmpresaFormRequest $request)
    {
        try{
           DB::beginTransaction();
        $empresa=new Empresa;
        $empresa->nombre=$request->get('nombre');
        $empresa->direccion=$request->get('direccion');
        $empresa->url=$request->get('url');
        $empresa->idRubro=$request->get('idRubro');
        $empresa->save();

        $idClave=$request->get('idClave');
        $nuevaClave=$request->get('nvaclave');

        $cont=0;
        while($cont < count($idClave)){
            if($idClave[$cont]=="nueva"){
                $clave=new Clave;
                $clave->nombre=$nuevaClave[$cont];
                $clave->save();

                $empresaClave=new EmpresaClave;
                $empresaClave->idEmpresa=$empresa->id;
                $empresaClave->idClave=$clave->id;
                $empresaClave->save();
            }else{
                $empresaClave=new EmpresaClave;
                $empresaClave->idEmpresa=$empresa->id;
                $empresaClave->idClave=$idClave[$cont];
                $empresaClave->save();
            }

            $cont=$cont+1;
        }

        DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return Redirect::to('vistas/empresa');
    }
    
    public function show($id)
    {
        return view("vistas.empresa.show",["empresa"=>Empresa::findOrFail($id)]);
    }
    public function edit($id)
    {
    	$rubros=DB::table('rubro')->get();
        return view("vistas.empresa.edit",["empresa"=>Empresa::findOrFail($id),"rubros"=>$rubros]);
    }
    public function update(EmpresaFormRequest $request,$id)
    {
        $empresa=Empresa::findOrFail($id);
        $empresa->nombre=$request->get('nombre');
        $empresa->direccion=$request->get('direccion');
        $empresa->url=$request->get('url');
        $empresa->idRubro=$request->get('idRubro');
        $empresa->update();
        return Redirect::to('vistas/empresa');
    }
    public function destroy($id)
    {
        $empresa=Empresa::findOrFail($id);
        $empresa->delete();
        return Redirect::to('vistas/empresa');
    }

}
