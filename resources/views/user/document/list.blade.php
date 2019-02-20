@extends('user/layouts.app')

@section('title', 'Edit document')
@section('active-main-menu-document', 'opened')
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
		        url: "{{ route('user.document.update-status') }}",
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
	<script type="text/javascript">
		$(document).ready(function() {
			$("#btn-search").click(function(){
				search();
			})
		});
		function search(){
			name 	= $('#name').val();
			category 	= $('#category').val();
			type 	= $('#type').val();
			limit 	= $('#limit').val();

			url="?limit="+limit;
			if(name!=""){
				url+='&name='+name;
			}
			if(category!=""){
				url+='&category='+category;
			}
			if(type!=""){
				url+='&type='+type;
			}
			
			$(location).attr('href', '{{ route('user.document.list') }}'+url);
		}
	</script>
@endsection

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Document</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.document.list') }}"  class="tabledit-delete-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-refresh"></span></a>
						<a href="{{ route('user.document.create') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
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
						<div class="col-xs-12 col-sm-12 col-md-3">
							<div class="form-group">
								<label class="form-label" for="from"></label>
								<input style="height: 39px;" type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ isset($_GET['name'])?$_GET['name']:"" }}">
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<div class="form-group">
								<label class="form-label" for="from"></label>
								
								<select class="select2" id="category" class="form-control">
									<?php 
										$first='';
										$othersx='';

										$category=isset($_GET['category'])?$_GET['category']:0;
										foreach($categories as $row){ 
											if($category==$row->id){
												$first='<option value="'.$row->id.'">'.$row->en_title.'</option>';
											}else{
												$othersx.='<option value="'.$row->id.'">'.$row->en_title.'</option>';
											}
										}
										echo $first.'<option value="0">Select Category</option>'.$othersx;
									?>
								</select> 
	                        </div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<div class="form-group">
								<label class="form-label" for="from"></label>
								
								<select class="select2" id="type" class="form-control">
									<?php 
										$first='';
										$othersx='';

										$type=isset($_GET['type'])?$_GET['type']:0;
										foreach($types as $row){ 
											if($type==$row->id){
												$first='<option value="'.$row->id.'">'.$row->en_title.'</option>';
											}else{
												$othersx.='<option value="'.$row->id.'">'.$row->en_title.'</option>';
											}
										}
										echo $first.'<option value="0">Select Type</option>'.$othersx;
									?>
								</select> 
	                        </div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-2">
							<fieldset class="form-group">
									<label class="form-label" for="exampleInput"></label>
									<button id="btn-search" type="button" class="btn btn-inline"><i class="fa fa-search"></i></button>
									
							</fieldset>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="table-responsive">
								<table id="table-edit" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Title</th>
											<th>Category</th>
											<th>Type</th>
											<th>Feature</th>
											<th>Updated Date</th>
											
											<th></th>
										</tr>
									</thead>
									<tbody>

										@php ($i = 1)
										@foreach ($data as $row)
										
											<tr>
												<td>{{ $i++ }}</td>
												<td>{{ $row->en_title }}</td>
												<td>{{ $row->category }}</td>
												<td>{{ $row->type }}</td>
												<td>
													<div class="checkbox-toggle">
												        <input onclick="updateStatus({{ $row->id }})" type="checkbox" id="status-{{ $row->id }}" @if ($row->published == 1) checked data-value="1" @else data-value="0" @endif >
												        <label for="status-{{ $row->id }}"></label>
											        </div>
												</td>
												<td>{{ $row->updated_at }}</td>
												
												<td style="white-space: nowrap; width: 1%;">
													<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
			                                           	<div class="btn-group btn-group-sm" style="float: none;">
			                                           		<a href="{{ route('user.document.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
			                                           		
			                                           		<a href="#" onclick="deleteConfirm('{{ route('user.document.trash', $row->id) }}', '{{ route('user.document.list') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
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
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<fieldset class="form-group">
									<label class="form-label" for="limit"><br /></label>
									<select class="form-control" id="limit" name="limit" style="width:70px">
										<option>10</option>
										<option>20</option>
										<option>30</option>
										<option>40</option>
										<option>50</option>
										<option>60</option>
										<option>70</option>
										<option>80</option>
										<option>90</option>
										<option>100</option>
									</select>
							</fieldset>
						</div>
						<div class="col-xs-12 col-sm-6 text-right">
							<br />
							{{ $data->links() }}


						</div>
					</div>
				</div>
				
					
			</section><!--.box-typical-->
		</div>
	</div><!--.container-fluid-->

@endsection