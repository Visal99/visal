@extends($route.'.main')
@section ('section-title', 'Feature')
@section ('hide-btn-back', 'display:none')
@section ('section-css')

@endsection
@section ('section-js')
	<script type="text/JavaScript">
			
	</script>
@endsection

@section ('section-content')
	@if(sizeof($data) > 0)
		<div class="table-responsive">
			<table id="table-edit" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>N. of Accesses</th>
						<th>Updated Date</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					@php ($i = 1)
					@foreach ($data as $row)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $row->name }}</td>
							
							<td>{{ count($row->accesses) }}</td>
							<td>{{ $row->updated_at }}</td>
							<td style="white-space: nowrap; width: 1%;">
								<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
		                           	<div class="btn-group btn-group-sm" style="float: none;">
		                           		<a href="{{ route($route.'.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
		                           		<a href="#" onclick="deleteConfirm('{{ route($route.'.trash', $row->id) }}', '{{ route($route.'.index') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
		                           	</div>
		                       </div>
		                    </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div >
	@else
		<span>No Data</span>
	@endif
@endsection