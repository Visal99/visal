@extends ($route.'.main')
@section ('section-title', 'Create New Contact')
@section ('section-css')
	<link href="{{ asset ('public/cp/css/plugin/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset ('public/cp/css/plugin/fileinput/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
	<!-- some CSS styling changes and overrides -->
	<style>
		.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
		    margin: 0;
		    padding: 0;
		    border: none;
		    box-shadow: none;
		    text-align: center;
		}
		.kv-avatar .file-input {
		    display: table-cell;
		    max-width: 220px;
		}
	</style>
@endsection

@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection

@section ('section-js')
	<script>
		
		var btnCust = ''; 
		$("#image").fileinput({
		    overwriteInitial: true,
		    maxFileSize: 1500,
		    showClose: false,
		    showCaption: false,
		    showBrowse: false,
		    browseOnZoneClick: true,
		    removeLabel: '',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-2',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="http://via.placeholder.com/870x429" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 870x429 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});

		
	</script>
@endsection

@section ('section-content')
	<div class="container-fluid">
		@include('cp.layouts.error')

		@php ($en_title = "")
		@php ($kh_title = "")
       
       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))
            @php ($en_title = $invalidData['en_title'])
            @php ($kh_title = $invalidData['kh_title'])
           
            
       	@endif
		<form id="form" action="{{ route($route.'.store') }}" name="form" method="POST"  enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="parent">Parent</label>
				<div class="col-sm-10">
					<select class="select2" id="parent" name="parent">
						<option value="">Select Parent</option>
	                   	@foreach ($parents as $row)
	                    	<option value="{{ $row->id }}"> {{ $row->en_title }}</option>
	                    @endforeach
	                    
	                </select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_title"
							name="kh_title"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Title in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Title (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_title"
							name="en_title"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Title in english "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_contact_person">Contact Person (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_contact_person"
							name="kh_contact_person"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Contact Person in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_contact_person">Contact Person (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_contact_person"
							name="en_contact_person"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Contact Person in english "
						   	class="form-control" />
							
				</div>
			</div>		
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_position">Position (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_position"
							name="kh_position"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Position in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_position">Position (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_position"
							name="en_position"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Position in english "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="website">Website</label>
				<div class="col-sm-10">
					<input 	id="website"
							name="website"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Enter website "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="phone">Phone </label>
				<div class="col-sm-10">
					<input 	id="phone"
							name="phone"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Enter phone "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="email">Email </label>
				<div class="col-sm-10">
					<input 	id="email"
							name="email"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Enter eamil "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_address">Address (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_address"
							name="kh_address"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Address in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_address">Address (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_address"
							name="en_address"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Address in english "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="google_link">Google Map Link</label>
				<div class="col-sm-10">
					<input 	id="google_link"
							name="google_link"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Enter Google Map Link "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="lat">Latitute</label>
							<div class="col-sm-10">
								<input 	id="lat"
										name="lat"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg.Enter Your Latitute"
									   	class="form-control"
									   	data-validation="[L>=1, L<=50]"
										data-validation-message="$ must be between 1and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="lng">Longtitute</label>
							<div class="col-sm-10">
								<input 	id="lng"
										name="lng"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg.Enter Your Longtitute"
									   	class="form-control"
									   	data-validation="[L>=1, L<=50]"
										data-validation-message="$ must be between 1and 50 characters. No special characters allowed." />
										
							</div>
						</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Published</label>
				<div class="col-sm-10">
					<div class="checkbox-toggle">
						<input id="status-status" type="checkbox" >
						<label onclick="booleanForm('status')" for="status-status"></label>
					</div>
					<input type="hidden" name="status" id="status" value="">
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