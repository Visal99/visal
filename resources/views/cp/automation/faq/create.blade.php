@extends('cp.automation.tab')
@section ('section-title', 'Add Faq')
@section ('tab-active-faq', 'active')



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
		<div class="col-md-12">
			<a href="{{ route($route.'.index', $id) }}" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-arrow-left"></span></a>
		</div>
	</div><!--.row-->
	@include('cp.layouts.error')


	<form id="form" action="{{ route($route.'.store') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<input type="hidden" name="automation_id" value="{{ $id}}">
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_question">Question (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_question"
										name="kh_question"
									   	value = ""
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
									   	value = ""
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
									   	value = ""
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
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Enter Answer in English."
									   	class="form-control"
									   	 />
										
							</div>
						</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-plus"></i> Create</button>
			</div>
		</div>
	</form>
	
@endsection