@extends('cp.layouts.app')
@php ($menu = "")
@if(isset($_GET['menu']))
    @php( $menu = $_GET['menu'])
@endif
@section('active-main-menu-'.$menu, 'opened')
@section('title', 'Edit Content')

@section ('appheadercss')
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
		    max-width: 220px;
		}
	</style>
@endsection
@if($data->image_required)
@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/user/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/user/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection
@section ('appbottomjs')
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
			$('#form').submit(function(event){
				event.prevenDefault();
				alert('This is form submit.');
			})

		}); 
		
	</script>
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
		    defaultPreviewContent: '<img src="{{ asset ($data->image) }}" alt="Missing Image" class="img img-responsive" ><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be {{ $data->width }}cmX{{ $data->height }}cm with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
@endsection
@endif


@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Content</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						@if(isset($_GET['page']))
							@if($_GET['page'] != "")
							 	@php ($menu = "")
							    @if(isset($_GET['menu']))
							        @php( $menu = $_GET['menu'])
							    @endif
								<a href="{{ route($route.'.list', ['page' => $_GET['page']]) }}?menu={{$menu}}&page={{ $_GET['page'] }}" class="btn"><i class="fa fa-arrow-left"></i></a>
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
			<div class="box-typical box-typical-padding">
				<div class="container-fluid">
					<h5 class="m-t-lg with-border">{{ $data->name }}</h5>
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
	              
					<form id="form" action="{{ route($route.'.update') }}?" name="form" method="POST"  enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<input type="hidden" name="id" value="{{ $data->id }}">
						<input type="hidden" name="slug" value="{{ $data->slug }}">
						<input type="hidden" name="image_required" value="{{ $data->image_required }}">
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_content">Content (kh)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="kh_content" name="kh_content" class="form-control @if($data->editor_required) summernote @endif "> {{ $data->kh_content }}</textarea>
								</div>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_content">Content (En)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="en_content" name="en_content" class="form-control @if($data->editor_required) summernote @endif "> {{ $data->en_content }}</textarea>
								</div>	
							</div>
						</div>
						@if($data->image_required)
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="email">Image</label>
							<div class="col-sm-10">
								<div class="kv-avatar center-block">
							        <input id="image" name="image" type="file" class="file-loading">
							    </div>
							    
							</div>
							<input type="hidden" name="width" value="{{ $data->width }}">
							<input type="hidden" name="height" value="{{ $data->height }}">
						</div>
						@endif
						<div class="form-group row">
							<label class="col-sm-2 form-control-label"></label>
							<div class="col-sm-10">
								
								<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
								
							</div>
						</div>
					</form>
				</div>
			</div><!--.box-typical-->
			
	</div><!--.container-fluid-->


	

@endsection