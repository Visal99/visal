@extends ($route.'.main')
@section ('section-title', 'Create New Project')
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
		    defaultPreviewContent: '<img src="http://via.placeholder.com/960x640" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 870x429 with .jpg or .png type</i></span>',
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
		@php ($en_description = "")
		@php ($kh_description = "")
		@php ($en_content = "")
		@php ($kh_content = "")
       
       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))
            @php ($en_title = $invalidData['en_title'])
            @php ($kh_title = $invalidData['kh_title'])
            @php ($en_description = $invalidData['en_description'])
            @php ($kh_description = $invalidData['kh_description'])
            @php ($en_content = $invalidData['en_content'])
            @php ($kh_content = $invalidData['kh_content'])
            
       	@endif
		<form id="form" action="{{ route($route.'.store') }}" name="form" method="POST"  enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			
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
				<label class="col-sm-2 form-control-label" for="category">Category</label>
				<div class="col-sm-10">
					 <select class="select2" id="category" name="category">
					 <option value="0">Select Category</option>
                       @foreach ($categories as $row)
                          <option value="{{ $row->id }}">{{ $row->en_name }}</option>
                        @endforeach

                      </select>
				</div>
			</div>
						
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_province">Province (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_province"
							name="kh_province"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Province in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_province">Province (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_province"
							name="en_province"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Province in english "
						   	class="form-control" />
							
				</div>
			</div>			
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_location">Location (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_location"
							name="kh_location"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Location in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_location">Location (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_location"
							name="en_location"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Location in english "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_authority">Authority (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_authority"
							name="kh_authority"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Authority in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_authority">Authority (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_authority"
							name="en_authority"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Authority in english "
						   	class="form-control" />
							
				</div>
			</div>	
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_constructor">Constructor (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_constructor"
							name="kh_constructor"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Constructor in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_constructor">Constructor (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_constructor"
							name="en_constructor"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Constructor in english "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_period">Period (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_period"
							name="kh_period"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Period in khmer "
						   	class="form-control" />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_period">Period (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_period"
							name="en_period"
						   	value = ""
						   	type="text"
						   	placeholder = "Eg. Period in english "
						   	class="form-control" />
							
				</div>
			</div>	

			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Content (KH)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="kh_content" name="kh_content" class="form-control  summernote "> </textarea>
					</div>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_content">Content (EN)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="en_content" name="en_content" class="form-control  summernote "> </textarea>
					</div>	
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="email">Image</label>
				<div class="col-sm-10">
					<div class="kv-avatar center-block">
				        <input id="image" name="image" type="file" class="file-loading">
				    </div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Publish</label>
				<div class="col-sm-10">
					<div class="checkbox-toggle">
						<input name="status" id="status" type="checkbox"   >
						<label onclick="change_status()" for="status"></label>
					</div>
					<input type="hidden" name="publish" id="publish" value="">
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