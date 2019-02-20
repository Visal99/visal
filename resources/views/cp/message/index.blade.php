@extends($route.'.main')
@section ('section-title', 'All Message')
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
			department 	= $('#department').val();
			url="?limit="+limit;
			if(key!=""){
				url+='&key='+key;
			}
			if(isDate(d_from)){
				if(isDate(d_till)){
					url+='&from='+d_from+'&till='+d_till;
				}
			}
			if(department!=0){
				url+='&department='+department;
			}
			$(location).attr('href', '{{ route($route.'.index') }}'+url);
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
			
			<select class="select2" id="department" class="form-control">
				<?php 
					$first='';
					$othersx='';

					$department = isset($_GET['department'])?$_GET['department']:0;
					foreach($departments as $row){ 
						if($department == $row->id){
							$first='<option value="'.$row->id.'">'.$row->en_title.'</option>';
						}else{
							$othersx.='<option value="'.$row->id.'">'.$row->en_title.'</option>';
						}
					}
					echo $first.'<option value="0">Select Department</option>'.$othersx;
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
				<tr>
					<th>#</th>
					<th>Department</th>
					<th>Name</th>
					<th>Organization</th>
					<th>Position</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Purpose</th>
					<th>Seen</th>
					<th></th>
				</tr>
			</thead>
		<tbody>
		
			
		
				@php ($i = 1)
				@foreach ($data as $row)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $row->contact->en_title }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->organization }}</td>
						<td>{{ $row->position }}</td>
						<td>{{ $row->phone }}</td>
						<td>{{ $row->email }}</td>
						<td>{{ $row->purpose }}</td>
						<td>
							<div class="checkbox-toggle">
						        <input type="checkbox" id="status-{{ $row->id }}" @if ($row->is_seen == 1) checked data-value="1" @else data-value="0" @endif >
						        <label for="status-{{ $row->id }}"></label>
					        </div>
						</td>
					<td style="white-space: nowrap; width: 1%;">
						<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                           	<div class="btn-group btn-group-sm" style="float: none;">
                           		<a href="{{ route($route.'.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
                           		<!-- <a href="#" onclick="deleteConfirm('{{ route($route.'.trash', $row->id) }}', '{{ route($route.'.index') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a> -->
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