@extends($route.'.main')
@if($data->id == 3 )
	@section ('section-title', 'Edit SEO')
@else
	@section ('section-title', 'Edit Banner')
@endif
@section ('section-css')
	<link href="{{ asset ('public/user/css/plugin/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset ('public/user/css/plugin/fileinput/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
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
		    max-width: 1000px;
		    max-height: 200px;
		}
	</style>
@endsection

@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/user/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/user/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection

@section ('section-js')
	@if($data->id == 1)
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
			    defaultPreviewContent: '<img src="{{ asset($data->img_url) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 1900x200 with .jpg or .png type</i></span>',
			    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
			    allowedFileExtensions: ["jpg", "png", "gif"]
			});
		</script>
	@elseif($data->id == 2)
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
			    defaultPreviewContent: '<img src="{{ asset($data->img_url) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 1000x200 with .jpg or .png type</i></span>',
			    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
			    allowedFileExtensions: ["jpg", "png", "gif"]
			});
		</script>

	@else
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
			    defaultPreviewContent: '<img src="{{ asset($data->img_url) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 400x200 with .jpg or .png type</i></span>',
			    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
			    allowedFileExtensions: ["jpg", "png", "gif"]
			});
		</script>
	@endif
@endsection

@section ('section-content')
	@include('cp.layouts.error')
	<form id="form" action="{{ route($route.'.update') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="id" value="{{ $data->id }}">
			

			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_image">Image</label>
				<div class="col-sm-10">
					<div class="kv-avatar center-block">
				        <input id="image" name="image" type="file" class="file-loading">
				    </div>
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