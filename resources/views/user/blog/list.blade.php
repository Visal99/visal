@extends('user/layouts.app')

@section('title', 'Edit Blog')

@section ('appbottomjs')
	<script type="text/javascript">
		$(document).ready(function() {
			
		});
		function updateStatus(id){

	    	
         	thestatus = $('#status-'+id);
         	publish = thestatus.attr('data-value');

         	if(publish == 1){
         		publish = 0;
         		thestatus.attr('data-value', 1);
         	}else{
         		publish = 1;
         		thestatus.attr('data-value', 0);
         	}

         	$.ajax({
		        url: "{{ route('user.blog.update-status') }}",
		        method: 'POST',
		        data: {id:id, publish:publish },
		        success: function( response ) {
		            if ( response.status === 'success' ) {
		            	swal("Nice!", response.msg ,"success");
		            	
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

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Blog</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.blog.list') }}"  class="tabledit-delete-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-refresh"></span></a>
						<a href="{{ route('user.blog.create') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="row">
			
			<section class="card">
				<div class="card-block">
					
					
					<div class="row">
						<div class="col-xs-12">
							<div class="table-responsive">
								<table id="table-edit" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Title</th>
											<th>Publish</th>
											<th>Updated Date</th>
											<th>Image</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										@php ($i = 1)
										@foreach ($data as $row)
										
											<tr>
												<td>{{ $i++ }}</td>
												<td>{{ $row->en_title }}</td>
												<td>
													<div class="checkbox-toggle">
												        <input onclick="updateStatus({{ $row->id }})" type="checkbox" id="status-{{ $row->id }}" @if ($row->published == 1) checked data-value="1" @else data-value="0" @endif >
												        <label for="status-{{ $row->id }}"></label>
											        </div>
												</td>
												<td>{{ $row->updated_at }}</td>
												 <td>
													<img src="{{ asset ($row->image) }}" class="img img-responsive thumbnail" alt="" data-toggle="tooltip" data-placement="bottom"  title="{{ $row->en_title }}">
												</td>
												<td style="white-space: nowrap; width: 1%;">
													<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
			                                           	<div class="btn-group btn-group-sm" style="float: none;">
			                                           		<a href="{{ route('user.blog.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
			                                           		
			                                           		<a href="#" onclick="deleteConfirm('{{ route('user.blog.trash', $row->id) }}', '{{ route('user.blog.list') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
			                                           	</div>
			                                       </div>
			                                    </td>
											</tr>
										
										@endforeach
										
										
									</tbody>
								</table>
							</div >
						</div>
					</div>
					
				</div>
				
					
			</section><!--.box-typical-->
		</div>
	</div><!--.container-fluid-->

@endsection