@extends('cp.contact.tab')
@section ('section-title', $contact->en_title.': Sub Departments')
@section ('tab-active-department', 'active')
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
				        url: "{{ route($route.'.sub-order') }}",
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
			
		</script>
	
@endsection
@section ('tab-content')
	
	<br />
	@if(sizeof($data) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
			<tr >
				<th>#</th>
				<th>Title</th>
				<!-- <th>Updated Date</th> -->
				<th></th>
			</tr>
		</thead>
		<tbody>
		
			
			@php ($i = 1)
			@foreach ($children as $row)
				<tr id="element-{{ $row->id }}" data-id="{{ $row->id }}" class="moveable" feature-order="{{ $row->sub_data_order }}" draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" ondragend="dragend(event)">
					<td>{{ $i++ }}</td>
					<td>{{ $row->en_title }}</td>
					
					<!-- <td>{{ $row->updated_at }}</td> -->
					<td style="white-space: nowrap; width: 1%;">
						<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                           	<div class="btn-group btn-group-sm" style="float: none;">
                           		<a href="{{ route('cp.contact.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
                           		
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