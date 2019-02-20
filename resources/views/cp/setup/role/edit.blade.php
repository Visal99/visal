@extends($route.'.tab')
@section ('section-title', 'Overview')
@section ('tab-active-edit', 'active')




@section ('section-js')
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
<div class="container-fluid">
	@include('user.layouts.error')
	<form id="form" action="{{ route($route.'.update') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="id" value="{{ $data->id }}">
		
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_name">Name</label>
			<div class="col-sm-10">
				<input 	id="name"
						name="name"
					   	value = "{{$data->name}}"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	data-validation="[L>=1, L<=200]"
						 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="kh_name">Note</label>
			<div class="col-sm-10">
				<textarea 	id="note"
						name="note"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	
						>{{$data->note}}</textarea>
						
			</div>
		</div>
			
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				<button type="button" onclick="deleteConfirm('{{ route($route.'.trash', $data->id) }}', '{{ route($route.'.index') }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
</div>
@endsection