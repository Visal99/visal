@extends('cp.public_work.tab')
@section ('section-title', 'Project')
@section ('tab-active-project', 'active')
@section ('tab-js')
	<script type="text/javascript">
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
				        url: "{{ route($route.'.orders') }}",
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
		     	active = thestatus.attr('data-value');

		     	if(active == 1){
		     		active = 0;
		     		thestatus.attr('data-value', 1);
		     	}else{
		     		active = 1;
		     		thestatus.attr('data-value', 0);
		     	}

		     	$.ajax({
			        url: "{{ route($route.'.update-status') }}",
			        method: 'POST',
			        data: {id:id, active:active },
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
@section ('tab-content')
	<br />
	<div class="row">
		<div class="col-md-12">
			
			<a href="{{ route($route.'.create', ['id'=>$id]) }}" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-plus"></span></a>
	
		</div>
	</div><!--.row-->
	<br />
	@if(sizeof($data) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Image</th>
					<th>Publish</th>
					<th>Updated Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@php ($i = 1)
				@foreach ($data as $row)
					<tr id="element-{{ $row->id }}" data-id="{{ $row->id }}" class="moveable" feature-order="{{ $row->data_order }}" draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" ondragend="dragend(event)">
						<td>{{ $i++ }}</td>
						<td>{{ $row->en_title }}</td>
						<td>
								<img style=" width: 200px;" src="{{ asset ($row->image_url) }}" alt="" data-toggle="tooltip" data-placement="bottom" title="{{ $row->en_title }}">
						</td>
						<td>
							<div class="checkbox-toggle">
						        <input onclick="updateStatus({{ $row->id }})" type="checkbox" id="status-{{ $row->id }}" @if ($row->is_published == 1) checked data-value="1" @else data-value="0" @endif >
						        <label for="status-{{ $row->id }}"></label>
					        </div>
						</td>
						<td>{{ $row->updated_at }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		
	                           		<a href="{{ route($route.'.edit', ['detail_id'=>$row->id,'id'=>$id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		<a href="#" onclick="deleteConfirm('{{ route($route.'.trash', ['id'=>$id, 'project_id'=>$row->id]) }}', '{{ route($route.'.index', ['id'=>$id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
	                           		
	                           	</div>
	                       </div>
	                    </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div >
	@else
	<span>No data here!</span>
	@endif
@endsection