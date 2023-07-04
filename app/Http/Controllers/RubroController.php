<?php

namespace topicoBuscador\Http\Controllers;

use Illuminate\Http\Request;
use topicoBuscador\Http\Requests;//ojo

use topicoBuscador\Rubro;
use Illuminate\Support\Facades\Redirect;
use topicoBuscador\Http\Requests\RubroFormRequest;
use DB;

class RubroController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $rubros=DB::table('rubro')->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('vistas.rubro.index',["rubros"=>$rubros,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("vistas.rubro.create");
    }
    public function store (RubroFormRequest $request)
    {

        //if ($request->ajax()) {
        //    return response()->json([
        //        "mensaje"=>$request->all()]);
        //}else{
        //     return Redirect::to('vistas/rubro');
       // }

       $rubro=new Rubro;
       $rubro->nombre=$request->get('nombre');
       $rubro->descripcion=$request->get('descripcion');
      //     $rubro->condicion='1';
       $rubro->save();
      return Redirect::to('vistas/rubro');

    }
    public function show($id)
    {
        return view("vistas.rubro.show",["rubro"=>Rubro::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("vistas.rubro.edit",["rubro"=>Rubro::findOrFail($id)]);
    }
    public function update(RubroFormRequest $request,$id)
    {
        $rubro=Rubro::findOrFail($id);
        $rubro->nombre=$request->get('nombre');
        $rubro->descripcion=$request->get('descripcion');
        $rubro->update();
        return Redirect::to('vistas/rubro');
    }
    public function destroy($id)
    {
        $rubro=Rubro::findOrFail($id);
        $rubro->delete();
        return Redirect::to('vistas/rubro');
    }


}
