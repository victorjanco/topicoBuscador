@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Rubros <a href="rubro/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('vistas.rubro.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
               @foreach ($rubros as $rub)
				<tr>
					<td>{{ $rub->id}}</td>
					<td>{{ $rub->nombre}}</td>
					<td>{{ $rub->descripcion}}</td>
					<td>
						<a href="{{URL::action('RubroController@edit',$rub->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$rub->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('vistas.rubro.modal')

				@endforeach
			</table>
		</div>
		{{$rubros->render()}}
	</div>
</div>
@stop