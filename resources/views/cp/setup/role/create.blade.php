@extends($route.'.main')
@section ('section-title', 'Create New Feature')
@section ('section-css')
	
@endsection


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

@section ('section-content')
	<div class="container-fluid">
		@include('user.layouts.error')

		@php ($name = "")
		@php ($note = "")
		
       
       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))

            @php ($name = $invalidData['name'])
            @php ($note = $invalidData['note'])
           
            
       	@endif
		<form id="form" action="{{ route($route.'.store') }}" name="form" method="POST"  enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_name">Title</label>
				<div class="col-sm-10">
					<input 	id="name"
							name="name"
						   	value = "{{$name}}"
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
						   	
							>{{$note}}</textarea>
							
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 form-control-label"></label>
				<div class="col-sm-10">
					<button type="submit" class="btn btn-success"> <fa class="fa fa-plus"></i> Create</button>
				</div>
			</div>
		</form>
	</div>

@endsection