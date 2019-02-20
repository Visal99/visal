@extends('cp.press.tab')
@section ('section-title', 'Edit News')
@section ('tab-active-edit', 'active')
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
		    defaultPreviewContent: '<img src="{{ asset($data->image) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 870x429 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
@endsection

@section ('tab-content')
	@include('cp.layouts.error')
	<form id="form" action="{{ route($route.'.update') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="id" value="{{ $data->id }}">
		
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_title"
										name="kh_title"
									   	value = "{{$data->kh_title}}"
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
						   	value = "{{$data->en_title}}"
						   	type="text"
						   	placeholder = "Eg. Title in english "
						   	class="form-control" />
							
				</div>
			</div>
						<div class="form-group row">
							<label for="category_id" class="col-sm-2 form-control-label">Category</label>
							<div class="col-sm-10">
								<select id="category-id" name="category" class="form-control">
									<option value="0" >Select Category</option>
									@foreach( $categories as $category)
										<option value="{{ $category->id }}" @if($data->category_id == $category->id) selected @endif >{{ $category->en_title }}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_content">Content (KH)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="kh_content" name="kh_content" class="form-control  summernote  ">{{$data->kh_content}} </textarea>
								</div>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_content">Content (EN)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="en_content" name="en_content" class="form-control  summernote  "> {{$data->en_content}}</textarea>
								</div>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="event_date">Event Date</label>
							<div class="col-sm-10">
								<div id="from-cnt" class='input-group date ' >
									<input id="event_date" name="event_date" type='text' class="form-control" value="{{$data->event_date}}" placeholder="Event Date" />
									<span class="input-group-addon">
										<i class="font-icon font-icon-calend"></i>
									</span>
								</div>		
							</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-2 form-control-label" for="kh_content">Published</label>
						<div class="col-sm-10">
							<div class="checkbox-toggle">
								<input id="status-status" type="checkbox"  @if($data->is_published ==1 ) checked @endif >
								<label onclick="booleanForm('status')" for="status-status"></label>
							</div>
							<input type="hidden" name="status" id="status" value="{{ $data->is_published }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label" for="kh_content">Featured</label>
						<div class="col-sm-10">
							<div class="checkbox-toggle">
								<input id="featured-featured" type="checkbox" @if($data->is_featured ==1 ) checked @endif >
								<label onclick="booleanForm('featured')" for="featured-featured"></label>
							</div>
							<input type="hidden" name="featured" id="featured" value="{{ $data->is_featured }}">
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
@endsection