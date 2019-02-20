@extends($route.'.tab')
@section ('section-title', "Property Access")
@section ('tab-active-access', 'active')

@section ('tab-js')
<script type="text/javascript">
	$(document).ready(function(){
		$('.item').click(function(){
			check_id = $(this).attr('for');
			access_id = $("#"+check_id).attr('access-id');
			check(access_id);
		})
	})
	function check(access_id){
		$.ajax({
		        url: "{{ route($route.'.check') }}?role_id={{ $id }}&access_id="+access_id,
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
		@foreach( $accesses as $access )
			@php( $check = "" )
	        @foreach($data as $row)
	            @if($row->access_id == $access->id)
	                @php( $check = "checked" )
	            @endif
	        @endforeach
			<div class="col-sm-6 col-sm-4 col-md-3 col-lg-3">
				<div class="checkbox-bird">
					<input type="checkbox" access-id="{{ $access->id }}" id="access-{{ $access->id }}" {{ $check }}>
					<label class="item" for="access-{{ $access->id }}">{{ ucwords(str_replace('-', ' ',$access->name)) }}</label>
				</div>
			</div>
		@endforeach
	</div>
		
	

@endsection