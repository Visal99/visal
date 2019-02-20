@extends('user/layouts.app')

@section('title', 'Image')
@section('active-main-menu-image', 'opened')
@section ('appbottomjs')
	<script type="text/javascript">
		$(document).ready(function() {
			
		});
		
	</script>
@endsection

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Image Upload</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.images.list') }}"  class="tabledit-delete-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-refresh"></span></a>
						<a href="{{ route('user.images.create') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
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
											<th>Link</th>
											<th>Image</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										@php ($i = 1)
										@foreach ($data as $row)
										
											<tr>
												<td>{{ $i++ }}</td>
												<td>{{ asset($row->image) }}</td>
												<td>
													<img src="{{ asset ($row->image) }}" class="img img-responsive thumbnail" alt="" data-toggle="tooltip" data-placement="bottom"  title="{{ $row->name }}">
												</td>
												<td> <a href="#" onclick="deleteConfirm('{{ route('user.images.trash', $row->id) }}', '{{ route('user.images.list') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a> </td>
												 
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