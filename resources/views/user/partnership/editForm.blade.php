@extends('user/layouts.app')

@section('title', 'Update partnership')

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
		function change_publish(){
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
		    defaultPreviewContent: '<img src="{{ asset ($data->logo) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be (100-500)cmX(100-500)cm with .jpg or .png type</i></span>',
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
						<h3>partnership</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.partnership.list') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-arrow-left"></span></a>
						<a href="{{ route('user.partnership.create') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
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
					<form id="form" action="{{ route('user.partnership.update') }}" name="form" method="POST"  enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<input type="hidden" name="id" value="{{ $data->id }}">
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_title">Title (Eng)</label>
							<div class="col-sm-10">
								<input 	id="en_title"
										name="en_title"
									   	value = "{{ $data->en_title }}"
									   	type="text"
									   	placeholder = "Eg. Jhon Son"
									   	class="form-control"
									   	data-validation="[L>=4, L<=50]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_title">Title (Kh)</label>
							<div class="col-sm-10">
								<input 	id="kh_title"
										name="kh_title"
									   	value = "{{ $data->kh_title }}"
									   	type="text"
									   	placeholder = "Eg. Jhon Son"
									   	class="form-control"
									   	data-validation="[L>=4, L<=50]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="website">Website</label>
							<div class="col-sm-10">
								<input 	id="website"
										name="website"
									   	value = "{{ $data->website }}"
									   	type="text"
									   	placeholder = "Eg. www.eng.com "
									   	class="form-control"
									   	data-validation="[L>=1, L<=50]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_description">Description (Eng)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="en_description" name="en_description" class="form-control  "> {{$data->en_description}} </textarea>
								</div>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_description">Description (KHM)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="kh_description" name="kh_description" class="form-control  ">{{$data->kh_description}} </textarea>
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
									<input name="publish" id="publish" type="checkbox"  @if($data->published ==1 ) checked @endif >
									<label onclick="change_publish()" for="publish"></label>
								</div>
								<input type="hidden" name="active" id="active" value="{{ $data->active }}">
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label"></label>
							<div class="col-sm-10">
								
								<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
								<button type="button" onclick="deleteConfirm('{{ route('user.user.trash', $data->id) }}', '{{ route('user.user.list') }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
							</div>
						</div>
					</form>
				</div>

				

			</div><!--.box-typical-->
			
	</div><!--.container-fluid-->

@endsection