@extends('cp.contact.tab')
@section ('section-title', 'View Contact')
@section ('tab-active-message', 'active')

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
		    max-width: 220px;
		}
	</style>
@endsection

@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/user/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/user/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection

@section ('section-js')
	<script>
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

			$("#url").blur(function(){
				url= $(this).val();
				if(url != ""){
					$("#iframe").attr("src", "//www.youtube.com/embed/"+url);
				}
			})
			
		}); 

		
	</script>
@endsection
@section ('tab-css')
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
			$("#video-cnt").hide();
			$("#url").blur(function(){
				url= $(this).val();
				if(url != ""){
					$("#video-cnt").show();
					$("#iframe").attr("src", "//www.youtube.com/embed/"+url);
				}
			})
			
		}); 
		
	</script>
	
@endsection

@section ('tab-content')
	<br />
	<div class="row">
		
	</div><!--.row-->
	@include('cp.layouts.error')
	<form id="form" action="{{ route($route.'.update') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="contact_id" value="{{ $id}}">
		<input type="hidden" name="message_id" value="{{ $data->id}}">
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Name</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "{{$data->name}}"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Organization</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "{{$data->organization}}"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Position</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "{{$data->position}}"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Phone</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "{{$data->phone}}"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Phone</label>
			<div class="col-sm-10">
				<input 	id="en_title"
						name="en_title"
					   	value = "{{$data->phone}}"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Email</label>
			<div class="col-sm-10">
				<input 	id="email"
						name="en_title"
					   	value = "{{$data->email}}"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label" for="en_title">Purpose</label>
			<div class="col-sm-10">
				<input 	id="email"
						name="en_title"
					   	value = "{{$data->purpose}}"
					   	type="text"
					   	placeholder = ""
					   	class="form-control"
					   	disabled="" 
					   	 />
						
			</div>
		</div>

		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_content">Message</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="kh_content" disabled="" name="kh_content" class="form-control">{{$data->message}} </textarea>
								</div>	
							</div>
						</div>
		
	</form>
	
@endsection