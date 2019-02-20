@extends('cp.document.tabForm')
@section ('section-title', "Public Service")
@section ('tab-active-system-permision', 'active')
@section ('tab-css')

@endsection

@section ('tab-js')
<script type="text/javascript">
	$(document).ready(function(){
		$('.item').click(function(){
			check_id = $(this).attr('for');
			automation_id = $("#"+check_id).attr('page-id');
			features(automation_id);
		})
	})
	function features(automation_id){
		$.ajax({
		        url: "{{ route($route.'.check-public-service') }}?document_id={{ $id }}&automation_id="+automation_id,
		        type: 'GET',
		        data: { },
		        success: function( response ) {
		            if ( response.status === 'success' ) {
		            	toastr.success(response.msg);
		            }else{
		            	swal("Error!", "Sorry there is an error happens. " ,"error");
		            }
		        },
		        error: function( response ) {
		           swal("Error!", "Sorry there is an error happens. " ,"error");
		        }
		});
	}
</script>

@endsection

@section ('tab-content')
	<br />
		
		
		
		<div class="row m-t-lg">
			@foreach( $automations as $page )
				@php( $check = "" )
		        @foreach($data as $row)
		            @if($row->automation_id == $page->id)
		                @php( $check = "checked" )
		            @endif
		        @endforeach
				<div class="col-sm-6 col-sm-4 col-md-3 col-lg-3">
					<div class="checkbox-bird">
						<input type="checkbox" page-id="{{ $page->id }}" id="page-{{ $page->id }}" {{ $check }}>
						<label class="item" for="page-{{ $page->id }}">{{ $page->en_title }}</label>
					</div>
				</div>
			@endforeach
		</div>
		<hr />

@endsection