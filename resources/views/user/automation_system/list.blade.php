@extends('user/layouts.app')

@section('title', 'Edit Automation System')
@section('active-main-menu-automation-system', 'opened')
@section ('appbottomjs')
	<script type="text/javascript">
		$(document).ready(function() {
			
		});

		var source;
			function isbefore(a, b) {
			    if (a.parentNode == b.parentNode) {
			        for (var cur = a; cur; cur = cur.previousSibling) {
			            if (cur === b) {
			                return true;
			            }
			        }
			    }
			    return false;
			}

			function dragenter(e) {
				
			    var targetelem = e.target;
			    //console.log(e);
			    if (targetelem.nodeName == "TD") {
			       targetelem = targetelem.parentNode;   
			    }  
			    
			    if (isbefore(source, targetelem)) {
			        targetelem.parentNode.insertBefore(source, targetelem);
			        //console.log('moved :'+order);
			    } else {
			        targetelem.parentNode.insertBefore(source, targetelem.nextSibling);

			    }
			}

			function dragstart(e) {
			    source = e.target;
			    e.dataTransfer.effectAllowed = 'move';

			}
			function dragend(e){
				//console.log(e.target);
				elements = $(".moveable");
				//console.log(elements);
				data = [];
				for(i=0; i<elements.length; i++){
					var obj = new Object();
					obj.id = $('#'+elements[i].id).attr('data-id');
					obj.order = i+1;
					data[i] = obj;
				}
				
				var string = JSON.stringify(data);
				console.log(string);
				$.ajax({
				        url: "{{ route('user.automation-system.order') }}",
				        type: 'POST',
				        data: {string:string},
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
		        url: "{{ route('user.automation-system.update-status') }}",
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
	<script>
		$(function() {
			$('#example').DataTable({
				rowReorder: true
			});
		});
	</script>
@endsection

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Automation System</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						<a href="{{ route('user.automation-system.list') }}"  class="tabledit-delete-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-refresh"></span></a>
						
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
										<tr >
											<th>#</th>
											<th>Title</th>
											<th>Updated Date</th>
											<th>Icon</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										@php ($i = 1)
										@foreach ($data as $row)
										
											<tr id="element-{{ $row->id }}" data-id="{{ $row->id }}" class="moveable" feature-order="{{ $row->featured_order }}" draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" ondragend="dragend(event)">
												<td>{{ $i++ }}</td>
												<td>{{ $row->en_title }}</td>
												
												<td>{{ $row->updated_at }}</td>
												 <td>
													<img src="{{ asset ($row->icon) }}" class="img img-responsive thumbnail" alt="" data-toggle="tooltip" data-placement="bottom"  title="{{ $row->en_title }}">
												</td>
												<td style="white-space: nowrap; width: 1%;">
													<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
			                                           	<div class="btn-group btn-group-sm" style="float: none;">
			                                           		<a href="{{ route('user.automation-system.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
			                                           		
			                                           		
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