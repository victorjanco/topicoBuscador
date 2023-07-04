@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Empresa: {{ $empresa->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($empresa,['method'=>'PATCH','route'=>['empresa.update',$empresa->id]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" value="{{$empresa->nombre}}" class="form-control" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="direccion">Direccion</label>
            	<input type="text" name="direccion" value="{{$empresa->direccion}}" class="form-control" placeholder="Direccion...">
            </div>
            <div class="form-group">
            	<label for="url">Url</label>
            	<input type="text" name="url" value="{{$empresa->url}}" class="form-control" placeholder="Url...">
            </div>
             
           	<div class="form-group">
                <label>Rubros</label>
                <select name="idRubro" class="form-control" id="idRubro">
                  @foreach($rubros as $rubro)
                   <option value="{{$rubro->id}}">{{$rubro->nombre}}</option>
                  @endforeach 
                </select>
          	</div>
       		
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection