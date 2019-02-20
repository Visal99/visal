@extends('cp.automation.tab')
@section ('section-title', 'View Location')
@section ('tab-active-location', 'active')
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
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw"></script>
	<script type="text/JavaScript">
		$(document).ready(function(){
			
			@if($data->lat != 0 && $data->lng !=0 )
				makeMap({{$data->lat}}, {{$data->lng}}, 20);
			@else 
				makeMap(11.537886, 104.910652, 20);// Map of phnom penh
			@endif
		})
		//var marker ="";
		function makeMap(lat, lng, zoom = 20){
			var latlng = new google.maps.LatLng(lat, lng);
			var map = new google.maps.Map(document.getElementById('map'), {
			    center: latlng,
			    zoom: zoom,
			    mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			var marker = new google.maps.Marker({
			    position: latlng,
			    map: map,
			    title: '',
			    draggable: true
			});
			google.maps.event.addListener(marker, 'dragend', function (event) {
			    $("#lat").val(this.getPosition().lat());
			    $("#lng").val(this.getPosition().lng());
			});
		}

		function enLargeMap(){

		}
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
		<input type="hidden" name="location_id" value="{{ $data->id}}">
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
							<div class="col-sm-10">
								<input 	id="kh_title"
										name="kh_title"
									   	value = "{{ $data->kh_title }}"
									   	type="text"
									   	placeholder = "Eg. Title in khmer "
									   	class="form-control"
									   	data-validation="[L>=4, L<=150]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
		<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="en_title">Title (EN)</label>
							<div class="col-sm-10">
								<input 	id="en_title"
										name="en_title"
									   	value = "{{ $data->en_title }}"
									   	type="text"
									   	placeholder = "Eg. Title in english"
									   	class="form-control"
									   	data-validation="[L>=4, L<=150]"
										data-validation-message="$ must be between 4and 50 characters. No special characters allowed." />
										
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" for="phone">Phone</label>
							<div class="col-sm-10">
								<input 	id="phone"
										name="phone"
									   	value = "{{$data->phone}}"
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
									   	value = "{{ $data->kh_address }}"
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
									   	value = "{{ $data->en_address }}"
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
									   	value = "{{$data->lat}}"
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
									   	value = "{{$data->lng}}"
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
									   	value = "{{$data->google_map_url}}"
									   	type="text"
									   	placeholder = "Eg. https://www.google.com/maps/place/Ministry+of+Public+Works+and+Transport"
									   	class="form-control"
									   	data-validation="[L>=1, L<=500]"
										data-validation-message="$ must be between 1 and 500 characters. No special characters allowed." />
										
							</div>
						</div>
						<!-- <div class="form-group row">
							<label class="col-sm-2 form-control-label" for="url">Frame</label>
							<div class="col-sm-10">
								<input 	id="frame"
										name="frame"
									   	value = "{{$data->frame}}"
									   	type="text"
									   	placeholder = "Eg. Enter your frame." 
									   	class="form-control"
									   	data-validation="[L>=1, L<=500]"
										data-validation-message="$ must be between 1 and 500 characters. No special characters allowed." />
										
							</div>
						</div> -->
						<div class="form-group row">
							<label class="col-sm-2 form-control-label" >Map</label>
							<div id="map-cnt" class="col-sm-10">
								<div id="map" style="height:400px;border: 1px solid gray;"></div>
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