@extends($route.'.main')
@section ('section-title', 'All Project')
@section ('display-btn-add-new', 'display:none')
@section ('section-css')



@endsection
@section ('section-js')
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
				        url: "{{ route($route.'.order') }}",
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

	$(document).ready(function() {
			$("#btn-search").click(function(){
				search();
			})
		});
		function search(){
			key 	= $('#key').val();
			d_from 		= $('#from').val();
			d_till 		= $('#till').val();
			limit 		= $('#limit').val();
			category 	= $('#category').val();
			url="?limit="+limit;
			if(key!=""){
				url+='&key='+key;
			}
			if(isDate(d_from)){
				if(isDate(d_till)){
					url+='&from='+d_from+'&till='+d_till;
				}
			}
			if(category!=""){
				url+='&category='+category;
			}
			$(location).attr('href', '{{ route($route.'.index') }}'+url);
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

@section ('section-content')

<div class="container-fluid">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-2">
		<div class="form-group">
			
			<input  type="text" class="form-control" id="key" placeholder="Key" value="{{ isset($appends['key'])?$appends['key']:'' }}">
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-2">
		<div class="form-group">
			
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

	<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="form-group">
				<div id="from-cnt" class='input-group date'>
					<input id="from" type='text' class="form-control" value="{{ isset($appends['from'])?$appends['from']:'' }}" placeholder="From" />
				<span class="input-group-addon">
					<i class="font-icon font-icon-calend"></i>
				</span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="form-group">
				<div id="till-cnt" class='input-group date ' >
					<input id="till" type='text' class="form-control" value="{{ isset($appends['till'])?$appends['till']:''  }}" placeholder="Till" />
					<span class="input-group-addon">
						<i class="font-icon font-icon-calend"></i>
					</span>
				</div>
			</div>
		</div>
	<div class="ccol-xs-12 col-sm-12 col-md-2">
		<button id="btn-search" class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
	</div>
</div>
@if(sizeof($data) > 0)
<div class="table-responsive">
	<table id="table-edit" class="table table-bordered table-hover">
		<thead>
			<tr >
				<th>#</th>
				<th>Title</th>
				<th>Category</th>
				<th>Publish</th>
				<th>Updated Date</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		
			
			@php ($i = 1)
			@foreach ($data as $row)
				<tr id="element-{{ $row->id }}" data-id="{{ $row->id }}" class="moveable" feature-order="{{ $row->featured_order }}" draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" ondragend="dragend(event)">
					<td>{{ $i++ }}</td>
					<td>{{ $row->en_title }}</td>
					<td>{{ $row->category->en_title }}</td>
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
                           		<a href="{{ route($route.'.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
                           		<a href="#" onclick="deleteConfirm('{{ route($route.'.trash', $row->id) }}', '{{ route($route.'.index') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
                           	</div>
                       </div>
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div >
@else
	<span>No Data</span>
@endif
<div class="row">
	<div class="col-xs-2">
		<select id="limit" onchange="search()" class="form-control" style="margin-top: 15px;width:50%">
			@if(isset($appends['limit']))
			<option>{{ $appends['limit'] }}</option>
			@endif
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
	</div>
	<div class="col-xs-10">

		{{ $data->appends($appends)->links('vendor.pagination.custom-html') }}
	</div>
</div>
</div>

@endsection