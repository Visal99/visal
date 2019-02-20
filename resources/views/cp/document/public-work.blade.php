@extends('cp.document.tabForm')
@section ('section-title', "Public Work")
@section ('tab-active-system-public-work', 'active')
@section ('tab-css')

@endsection

@section ('tab-js')
<script type="text/javascript">
	$(document).ready(function(){
		$('.item').click(function(){
			check_id = $(this).attr('for');
			public_work_id = $("#"+check_id).attr('page-id');
			features(public_work_id);
		})
	})
	function features(public_work_id){
		$.ajax({
		        url: "{{ route($route.'.check-public-work') }}?document_id={{ $id }}&public_work_id="+public_work_id,
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
			@foreach( $public_works as $page )
				@php( $check = "" )
		        @foreach($data as $row)
		            @if($row->public_work_id == $page->id)
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