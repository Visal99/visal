@extends('user/layouts.app')

@section('title', 'Update Automation System')
@section('active-main-menu-automation-system', 'opened')
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
	
	

	
@endsection

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Automation System</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.automation-system.edit', $data->id) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-arrow-left"></span></a>
						<a href="{{ route('user.automation-system.create-faq',$data->id) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span> Add New Faq</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
			<div class="box-typical box-typical-padding">
					
				<div class="container-fluid">
					<section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-icons">
					<div class="tbl">
						<ul class="nav" role="tablist">
							<li class="nav-item">
								<a class="nav-link" onclick="window.location.href='{{ route('user.automation-system.edit', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<i class="fa fa-info"></i>
										Information
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" onclick="window.location.href='{{ route('user.automation-system.list-location', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-flag"></span>
										Location
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " onclick="window.location.href='{{ route('user.automation-system.list-video', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-home"></span>
										Video
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" onclick="window.location.href='{{ route('user.automation-system.list-manual', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-bookmark"></span>
										Manual
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " onclick="window.location.href='{{ route('user.automation-system.list-document', ['id'=>$data->id,'slug'=>$data->slug]) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-file"></span>
										Regulation
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" onclick="window.location.href='{{ route('user.automation-system.list-faq', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-pencil"></span>
										Faq
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div><!--.tabs-section-nav-->

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
					<form id="form" action="{{ route('user.automation-system.update-faq',$data->id) }}" name="form" method="POST"  enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<input type="hidden" name="id" value="{{ $automation_faq->id }}">
						<input type="hidden" name="automation_system_id" value="{{ $data->id }}">
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_title">Title (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_title"
										name="en_title"
									   	value = "{{ $automation_faq->en_title }}"
									   	type="text"
									   	placeholder = "Eg. Jhon Son"
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_title"
										name="kh_title"
									   	value = "{{ $automation_faq->kh_title }}"
									   	type="text"
									   	placeholder = "Eg. Title "
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_description">Description (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_description"
										name="en_description"
									   	value = "{{ $automation_faq->en_description }}"
									   	type="text"
									   	placeholder = "Eg. Enter Description in English."
									   	class="form-control"
									   	/>
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_description">Description (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_description"
										name="kh_description"
									   	value = "{{ $automation_faq->kh_description }}"
									   	type="text"
									   	placeholder = "Eg. Enter Description in Khmer "
									   	class="form-control"
									   	 />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_content">Publish</label>
							<div class="col-sm-10">
								<div class="checkbox-toggle">
									<input name="publish" id="publish" type="checkbox"  @if($automation_faq->published ==1 ) checked @endif >
									<label onclick="change_status()" for="publish"></label>
								</div>
								
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label"></label>
							<div class="col-sm-10">
								
								<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
								<button type="button" onclick="deleteConfirm('{{ route('user.automation-system.trash-faq', $automation_faq->id) }}', '{{ route('user.automation-system.list-faq',$data->id) }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
							</div>
						</div>
					</form>
					
				</div>
				</div><!--.tab-content-->
			</section><!--.tabs-section-->
				

			</div><!--.box-typical-->
			
	</div><!--.container-fluid-->

@endsection