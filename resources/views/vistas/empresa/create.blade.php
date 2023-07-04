@extends ('layouts.admin')
@section ('contenido')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Empresa</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
    </div>
  </div>
			{!!Form::open(array('url'=>'vistas/empresa','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
      <div class="row"> 
          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">   
            	<div class="form-group">
            		<label for="nombre">Nombre</label>
            		<input type="text" name="nombre" class="form-control" placeholder="Nombre...">
           		</div>

              <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" class="form-control" placeholder="Direccion...">
              </div>

              <div class="form-group">
                <label for="url">Url</label>
                <input type="text" name="url" class="form-control" placeholder="Url...">
              </div>

              <div class="form-group">
                <label>Rubros</label>
                <select name="idRubro" class="form-control" id="idRubro">
                  @foreach($rubros as $rubro)
                   <option value="{{$rubro->id}}">{{$rubro->nombre}}</option>
                  @endforeach 
                </select>
              </div>
        	</div>
        	
         
              <div class="class=col-lg-4 col-sm-4 col-md-4 col-xs-12">
              <label>Ubicacion</label>
              <div id="map">
        
              </div>
              
              </div>
       		
    </div>  


<div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                 <div class="form-group">
                          <label>Claves</label>
                          <select name="pidClave" class="form-control" id="pidClave">
                           @foreach($claves as $clave)
                            <option value="{{$clave->id}}">{{$clave->nombre}}</option>
                           @endforeach 
                          </select>
                  </div>
                 </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                     <div class="form-group">
                     <label for="pnvaclave">Nueva clave</label>
                     <input type="text" id="pnvaclave" name="pnvaclave" class="form-control" placeholder="Clave...">
                    </div>
                </div> 
                    
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                           <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>

                     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                           <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                               <thead style="background-color:#A9D0F5">
                                   <th>Opciones</th>
                                   <th>Clave</th>
                                  
                               </thead>
                               <tfoot>
                                   <th>TOTAL</th>
                                   <th></th>
                                   
                               </tfoot>
                               <tbody>
                                   
                               </tbody>
                           </table>
                        </div>
                    </div>

            </div>
        </div>
    

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
            <div class="form-group">
              <input  name="_token" value="{{csrf_token() }}" type="hidden"></input>
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>  
            </div>
        </div>
  </div>    

      {!!Form::close()!!}   
   
  @push ('scripts')
      <script>

          $(document).ready(function(){
            $('#bt_add').click(function(){
                agregar();
            });
          });

          var cont=0;
          total=0;
          subtotal=[];
          $("#guardar").hide();

          function agregar()
          {
             idClave=$("#pidClave").val();
             clave=$("#pidClave option:selected").text();
             nvaclave=$("#pnvaclave").val();

             if (nvaclave!="") 
             {
                subtotal[cont]=1;
                total=total+subtotal[cont];

                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idClave[]" value="nueva">'+'<input type="hidden" name="nvaclave[]" value="'+nvaclave+'">'+nvaclave+'</td></tr>';
                cont++;
                limpiar();
               // $("#total").html("S/."+total);
                evaluar();
                $("#detalles").append(fila);
             }else if(idClave!=""){
                subtotal[cont]=1;
                total=total+subtotal[cont];

                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idClave[]" value="'+idClave+'">'+'<input type="hidden" name="nvaclave[]" value="">'+clave+'</td></tr>';
                cont++;
                limpiar();
              //  $("#total").html("S/."+total);
                evaluar();
                $("#detalles").append(fila);
             }else{
                alert("Error al ingresar el detalle del ingreso, revice los datos del articulo");
             }
          }

          function limpiar()
          {
            $("#nvaclave").val("");
           // $("#pcantidad").val("");
           //  $("#pprecio_compra").val("");
           // $("#pprecio_venta").val("");
          }

          function evaluar()
          {
            if (total>0) {
                $("#guardar").show();
            }else{
                $("#guardar").hide();
            }
          }
          function eliminar(index){
        //    total=total-subtotal[index];
        //    $("#total").html("S/. " +total);
            $("#fila"+index).remove();
            evaluar();
          }


      </script>
     @endpush          
@stop
