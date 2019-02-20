@extends($route.'.main')
@section ('section-title', $contact->en_title)
@section ('display-btn-add-new', '')
@section ('display-btn-back', 'display:none')
@section('active-main-menu-contact-general-department', 'opened')
@section ('section-css')

@endsection
@section ('section-js')

@endsection

@section ('section-content')
	

	@if(sizeof($departments) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Departments</th>
					<th>Updated Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@php ($i = 1)
				@foreach ($departments as $row)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $row->en_title }}</td>
						<td>{{ $row->updated_at }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		<a href="{{ route($route.'.edit', ['contact_id'=>$contact->id, 'department_id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		<a href="#"  class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="fa fa-trash"></span></a>
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