@extends('user/layouts.app')

@section('title', 'Update Document')
@section('active-main-menu-document', 'opened')
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
		function change_status(){
			val 	= $('#publish').val();
			if(val == 0){
				$('#publish').val(1);
			}else{
				$('#publish').val(0);
			}
		}
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
		    defaultPreviewContent: '<img src="{{ asset ($data->image) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be (100-500)cmX(100-500)cm with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
	

	
@endsection

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Document</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.document.list') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-arrow-left"></span></a>
						<a href="{{ route('user.document.create') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
			<div class="box-typical box-typical-padding">
					
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
					<form id="form" action="{{ route('user.document.update') }}" name="form" method="POST"  enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<input type="hidden" name="id" value="{{ $data->id }}">
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_title">Title (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_title"
										name="en_title"
									   	value = "{{ $data->en_title }}"
									   	type="text"
									   	placeholder = "Eg. Jhon Son"
									   	class="form-control" />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_title"
										name="kh_title"
									   	value = "{{ $data->kh_title }}"
									   	type="text"
									   	placeholder = "Eg. Title "
									   	class="form-control" />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="category">Category</label>
							<div class="col-sm-10">
								 <select class="select2" id="category" name="category">
								 
	                               @foreach ($categories as $row)
	                                  <option value="{{ $row->id }}"  <?php if($data->category_id==$row->id){ echo "selected"; }else{ echo""; } ?>>{{ $row->en_title }}</option>
	                                @endforeach
	                                <option value="0">Select Category</option>
	                              </select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="type">Type</label>
							<div class="col-sm-10">
								 <select class="select2" id="type" name="type">
								
	                               @foreach ($types as $row)
	                                  <option value="{{ $row->id }}"  <?php if($data->type_id==$row->id){ echo "selected"; }else{ echo""; } ?>>{{ $row->en_title }}</option>
	                                @endforeach
	                                 
	                              </select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="google_link">Google Link</label>
							<div class="col-sm-10">
								<input 	id="google_link"
										name="google_link"
									   	value = "{{$data->google_link}}"
									   	type="text"
									   	placeholder = "Eg. Enter Google shareble link "
									   	class="form-control" />
										
							</div>
						</div>
						<!-- <div class="form-group row">
							<label class="col-sm-2 form-control-label" for="email">PDF</label>
							<div class="col-sm-10">
								<div class="drop-zone">
									
									<i class="font-icon font-icon-cloud-upload-2"></i>
									<div class="drop-zone-caption">Drag file to upload</div>
									<span class="btn btn-rounded btn-file">
										<span>Choose file</span>
										<input type="file" id="pdf" name="pdf" multiple="">
									</span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="email">File</label>
							<div class="col-sm-10">
								<div class="proj-page-attach">
								<i class="font-icon font-icon-pdf"></i>
								<p>
									<a href="{{asset ($data->pdf)}}">View</a>
									<a href="{{asset ($data->pdf)}}">Download</a>
								</p>
							</div>
							</div>
						</div> -->
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
									<input name="status" id="status" type="checkbox"  @if($data->published ==1 ) checked @endif >
									<label onclick="change_status()" for="status"></label>
								</div>
								<input type="hidden" name="publish" id="publish" value="{{ $data->published }}">
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="tag">Tag</label>
							<div class="col-sm-10">
								<select name="tag[]" class="select2 select2-hidden-accessible" multiple="multiple" tabindex="-1" aria-hidden="true">
									
									@foreach($tags as $row)
									
									@php ($selected="")
									@foreach($data_tags as $data_tag)
											@if($data_tag->tag_id == $row->id)
												@php ($selected="selected")
											@endif
									@endforeach
									<option value="{{$row->id}}" <?php echo $selected; ?> data-icon="font-icon-home">{{$row->en_title}}</option>
									

									@endforeach
								</select>


								<br>
								<br>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label"></label>
							<div class="col-sm-10">
								
								<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
								<button type="button" onclick="deleteConfirm('{{ route('user.document.trash', $data->id) }}', '{{ route('user.document.list') }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
							</div>
						</div>
					</form>
				</div>

				

			</div><!--.box-typical-->
			
	</div><!--.container-fluid-->
	

@endsection
