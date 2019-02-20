@extends('user/layouts.app')

@section('title', 'Update Public Work')
@section('active-main-menu-public-word', 'opened')
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
		
	</script>

	

	
@endsection

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Public Work</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.public-work.list') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-arrow-left"></span></a>
						
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
			<div class="box-typical box-typical-padding">
					
				<div class="container-fluid">
					<div class="box-typical box-typical-padding">
					
				<div class="container-fluid">
					<section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-icons">
					<div class="tbl">
						<ul class="nav" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" onclick="window.location.href='{{ route('user.public-work.edit', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<i class="fa fa-info"></i>
										Information
									</span>
								</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" onclick="window.location.href='{{ route('user.public-work.list-project', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-home"></span>
										Project
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" onclick="window.location.href='{{ route('user.public-work.list-document', ['id'=>$data->id,'slug'=>$data->slug]) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-home"></span>
										Regulation
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
					<form id="form" action="{{ route('user.public-work.update') }}" name="form" method="POST"  enctype="multipart/form-data">
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
									   	class="form-control"
									   	data-validation="[L>=4, L<=50]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
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
									   	class="form-control"
									   	data-validation="[L>=4, L<=50]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_content">Content (EN)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="en_content" name="en_content" class="form-control  summernote  "> {{ $data->en_content }} </textarea>
								</div>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_content">Content (KH)</label>
							<div class="col-sm-10">
								<div class="summernote-theme-1">
									<textarea id="kh_content" name="kh_content" class="form-control  summernote  "> {{ $data->kh_content }} </textarea>
								</div>	
							</div>
						</div>
						
						
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label"></label>
							<div class="col-sm-10">
								
								<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
								<button type="button" onclick="deleteConfirm('{{ route('user.public-work.trash', $data->id) }}', '{{ route('user.public-work.list') }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
							</div>
						</div>
					</form>
				</div>
					</div><!--.tab-content-->
			</section><!--.tabs-section-->
				

			</div><!--.box-typical-->
			
	</div><!--.container-fluid-->

@endsection