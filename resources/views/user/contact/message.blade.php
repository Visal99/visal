@extends($route.'.tabForm')
@php( $department_name ="" )
@if( $contact->has_departments == 1 )
	@php( $department_name =" -> ".$data->en_title )
	@section('active-main-menu-contact-general-department', 'opened')
@endif
@section ('section-title', $contact->en_title.$department_name )
@section ('tab-active-message', 'active')
@section('active-main-menu-contact', 'opened')
@section ('tab-css')
	
@endsection


@section ('tab-js')
	<script type="text/JavaScript">
		$(document).ready(function(event){
		
			$('#form').validate({
				modules : 'file',
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			}); 
			
		});


	</script>

@endsection

@section ('tab-content')
	@if(sizeof($messages) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Organization</th>
					<th>Position</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Message</th>
				</tr>
			</thead>
			<tbody ondrop="alert('ddd')">

				@php ($i = 1)
				@foreach ($messages as $row)
					<tr id="element-{{ $row->id }}" data-id="{{ $row->id }}" class="moveable" feature-order="" draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" ondragend="dragend(event)">
						<td>{{ $i++ }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->organization }}</td>
						<td>{{ $row->position}}</td>
						<td>{{ $row->phone}}</td>
						<td>{{ $row->email}}</td>
						<td><textarea class="form-control">{{ $row->message}}</textarea></td>
						
					</tr>
				@endforeach
			</tbody>
		</table>
	</div >
	@else
	<span>No Data</span>
	@endif
@endsection