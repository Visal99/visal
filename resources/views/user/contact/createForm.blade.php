@extends($route.'.main')
@section ('section-title', 'New Department')
@section ('section-css')
	
@endsection

@section ('imageuploadjs')
  
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


		@php ($kh_title = "")
		@php ($en_title = "")
		@php ($website = "")
		@php ($url = "")
		@php ($phone = "")
		@php ($email = "")
		@php ($address = "")
		@php ($lat = "")
		@php ($lon = "")

       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))

			@php ($kh_title = $invalidData['kh_title'])
			@php ($en_title = $invalidData['en_title'])
			@php ($website = $invalidData['website'])
			@php ($url = $invalidData['url'])
			@php ($phone = $invalidData['phone'])
			@php ($email = $invalidData['email'])
			@php ($address = $invalidData['address'])
			@php ($lat = $invalidData['lat'])
            @php ($lon = $invalidData['lon'])

          
       	@endif
		<form id="form" action="{{ route($route.'.store') }}" name="form" method="POST"  enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<input type="hidden" name="contact_id" value={{ $contact->id }} />
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Title (Kh)</label>
				<div class="col-sm-10">
					<input 	id="kh-title"
							name="kh-title"
							value = "{{ $kh_title }}"
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
							value = "{{ $en_title }}"
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
							value = "{{ $website }}"
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
							value = "{{ $url }}"
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
							value = "{{ $phone }}"
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
							value = "{{ $email }}"
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
							value = "{{ $address }}"
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
							value = "{{ $lat }}"
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
							value = "{{ $lon }}"
							type="text"
							placeholder = ""
						   	class="form-control"
						   	data-validation="[L>=2, L<=200]" />
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