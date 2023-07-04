@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Empresas <a href="empresa/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('vistas.empresa.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Direccion</th>
					<th>url</th>
					<th>Opciones</th>
				</thead>
               @foreach ($empresas as $emp)
				<tr>
					<td>{{ $emp->id}}</td>
					<td>{{ $emp->nombre}}</td>
					<td>{{ $emp->direccion}}</td>
					<th>{{ $emp->url}}</th>
					<td>
						<a href="{{URL::action('EmpresaController@edit',$emp->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$emp->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('vistas.empresa.modal')

				@endforeach
			</table>
		</div>
		{{$empresas->render()}}
	</div>
</div>
@stop