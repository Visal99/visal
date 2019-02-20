@extends('cp.automation.tab')
@section ('section-title', 'View Detail')
@section ('tab-active-faq', 'active')
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
		    defaultPreviewContent: '<img src="{{ asset($data->image) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 200x165 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
		
	</script>
	
@endsection

@section ('tab-content')
	<br />
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route($route.'.create', $id) }}" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right; margin-left: 4px;"><span class="fa fa-plus"></span></a> &nbsp;
			<a href="{{ route($route.'.index', $id) }}" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-arrow-left"></span></a>
		</div>
	</div><!--.row-->
	@include('cp.layouts.error')
	<form id="form" action="{{ route($route.'.update') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="automation_id" value="{{ $id}}">
		<input type="hidden" name="faq_id" value="{{ $data->id}}">
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_question">Question (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_question"
										name="kh_question"
									   	value = "{{$data->kh_question}}"
									   	type="text"
									   	placeholder = "Eg. Enter Question in English. "
									   	class="form-control"
									   	 />
										
							</div>
						</div>
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_question">Question (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_question"
										name="en_question"
									   	value = "{{$data->en_question}}"
									   	type="text"
									   	placeholder = "Eg. Enter Question in English."
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_answer">Answer (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_answer"
										name="kh_answer"
									   	value = "{{$data->kh_answer}}"
									   	type="text"
									   	placeholder = "Eg. Enter Answer in Khmer "
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_answer">Answer (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_answer"
										name="en_answer"
									   	value = "{{$data->en_answer}}"
									   	type="text"
									   	placeholder = "Eg. Enter Answer in English."
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						
		
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				<button type="button" onclick="deleteConfirm('{{ route($route.'.trash', ['id'=>$id, 'faq_id'=>$data->id]) }}', '{{ route($route.'.index', $id) }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
	
@endsection