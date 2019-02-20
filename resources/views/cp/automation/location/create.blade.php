@extends('cp.automation.tab')
@section ('section-title', 'Add Location')
@section ('tab-active-location', 'active')



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
							<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_title"
										name="kh_title"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Title in khmer"
									   	class="form-control"
									   	data-validation="[L>=4, L<=100]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_title">Title (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_title"
										name="en_title"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Title in english"
									   	class="form-control"
									   	data-validation="[L>=4, L<=100]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="phone">Phone</label>
							<div class="col-sm-10">
								<input 	id="phone"
										name="phone"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Enter phone number "
									   	class="form-control"
									   	data-validation="[L>=1, L<=100]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_address">Address (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_address"
										name="kh_address"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Corner Norodom Blvd/Street 106,Phnom Penh, Cambodia "
									   	class="form-control"
									   	data-validation="[L>=4, L<=100]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_address">Address (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_address"
										name="en_address"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. Corner Norodom Blvd/Street 106,Phnom Penh, Cambodia"
									   	class="form-control"
									   	data-validation="[L>=4, L<=100]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="lat">Latitute</label>
							<div class="col-sm-10">
								<input 	id="lat"
										name="lat"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg.Enter Your Latitute"
									   	class="form-control"
									   	data-validation="[L>=1, L<=50]"
										data-validation-message="$ must be between 1and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="lng">Longtitute</label>
							<div class="col-sm-10">
								<input 	id="lng"
										name="lng"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg.Enter Your Longtitute"
									   	class="form-control"
									   	data-validation="[L>=1, L<=50]"
										data-validation-message="$ must be between 1and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="url">Url</label>
							<div class="col-sm-10">
								<input 	id="url"
										name="url"
									   	value = ""
									   	type="text"
									   	placeholder = "Eg. https://www.google.com/maps/place/Ministry+of+Public+Works+and+Transport"
									   	class="form-control"
									   	data-validation="[L>=1, L<=500]"
										data-validation-message="$ must be between 1 and 500 characters. No special characters allowed." />
										
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