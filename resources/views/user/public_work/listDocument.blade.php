@extends('user/layouts.app')

@section('title', 'Edit public-work')
@section('active-main-menu-public-word', 'opened')
@section ('appbottomjs')
	<script type="text/javascript">
		$(document).ready(function() {
			
		});
		function updateStatus(id){

	    	
         	thestatus = $('#status-'+id);
         	feature = thestatus.attr('data-value');

         	if(feature == 1){
         		feature = 0;
         		thestatus.attr('data-value', 1);
         	}else{
         		feature = 1;
         		thestatus.attr('data-value', 0);
         	}

         	$.ajax({
		        url: "{{ route('user.public-work.update-status') }}",
		        method: 'POST',
		        data: {id:id, feature:feature },
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
						<h3>public-work</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.public-work.list-project',$data->id) }}"  class="tabledit-delete-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-refresh"></span></a>
						<a href="{{ route('user.public-work.create-document',$data->id) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"> Add New Regulation</span></a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-icons">
					<div class="tbl">
						<ul class="nav" role="tablist">
							<li class="nav-item">
								<a class="nav-link " onclick="window.location.href='{{ route('user.public-work.edit', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<i class="fa fa-info"></i>
										Information
									</span>
								</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link " onclick="window.location.href='{{ route('user.public-work.list-project', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-home"></span>
										Project
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" onclick="window.location.href='{{ route('user.public-work.list-document', ['id'=>$data->id,'slug'=>$data->slug]) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-home"></span>
										Regulation
									</span>
								</a>
							</li>
							
						</ul>
					</div>
				</div><!--.tabs-section-nav-->
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
											
											<th>Type</th>
											
											<th>Updated Date</th>
											
											<th></th>
										</tr>
									</thead>
									<tbody>

										@php ($i = 1)
										@foreach ($documents as $row)
										
											<tr>
												<td>{{ $i++ }}</td>
												<td>{{ $row->en_title }}</td>
												<td>{{ $row->type }}</td>
												
												<td>{{ $row->updated_at }}</td>
												
												<td style="white-space: nowrap; width: 1%;">
													<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
			                                           	<div class="btn-group btn-group-sm" style="float: none;">
			                                           		<a href="{{ route('user.public-work.edit-document',['id'=>$row->id,'public_work_id'=>$data->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
			                                           		
			                                           		<a href="#" onclick="deleteConfirm('{{ route('user.public-work.trash-document', $row->id) }}', '{{ route('user.public-work.list-document',['id'=>$data->id,'slug'=>$data->slug]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
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
					
				</div>
				</div><!--.tab-content-->
			</section><!--.tabs-section-->
				

			</div><!--.box-typical-->
			
	</div><!--.container-fluid-->

@endsection