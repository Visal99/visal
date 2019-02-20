@extends($route.'.tabForm')
@php( $department_name ="" )
@if( $contact->has_departments == 1 )
	@php( $department_name =" -> ".$data->en_title )
	@section('active-main-menu-contact-general-department', 'opened')
@endif
@section ('section-title', $contact->en_title.$department_name )
@section ('tab-active-edit', 'active')
@section('active-main-menu-contact', 'opened')

@if($data->slug == 'department-of-information-technology-and-public-relation' || $data->slug == 'department-of-internal-audit' || $data->slug == 'department-of-railway' )
	@section('active-main-menu-contact-department', 'opened')	
@endif




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
	<br />
	@if (count($errors) > 0)
	    <div class="form-error-text-block">
	        <h2 style="color:red"> Error Occurs</h2>
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	<form id="form" action="{{ route($route.'.update') }}" name="form" method="POST"  enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('POST') }}
			<input type="hidden" name="id" value="{{ $data->id }}">
			<input type="hidden" name="contact_id" value="{{ $data->contact_id }}">
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Title (Kh)</label>
				<div class="col-sm-10">
					<input 	id="kh-title"
							name="kh-title"
							value = "{{ $data->kh_title }}"
							type="text"
							placeholder = ""
							class="form-control"
						    data-validation="[L>=1, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Title (En)</label>
				<div class="col-sm-10">
					<input 	id="en-title"
							name="en-title"
							value = "{{ $data->en_title }}"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Website</label>
				<div class="col-sm-10">
					<input 	id="website"
							name="website"
							value = "{{ $data->website }}"
							type="url"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=50]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Url</label>
				<div class="col-sm-10">
					<input 	id="url"
							name="url"
							value = "{{ $data->url }}"
							type="url"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=1, L<=500]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Phone</label>
				<div class="col-sm-10">
					<input 	id="phone"
							name="phone"
							value = "{{ $data->phone }}"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=50]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Email</label>
				<div class="col-sm-10">
					<input 	id="email"
							name="email"
							value = "{{ $data->email }}"
							type="email"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Address</label>
				<div class="col-sm-10">
					<input 	id="address"
							name="address"
							value = "{{ $data->address }}"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Latitute</label>
				<div class="col-sm-10">
					<input 	id="lat"
							name="lat"
							value = "{{ $data->lat }}"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Longtitute</label>
				<div class="col-sm-10">
					<input 	id="lon"
							name="lon"
							value = "{{ $data->lon }}"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label"></label>
				<div class="col-sm-10">
					<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				</div>
			</div>
		</form>
	
@endsection