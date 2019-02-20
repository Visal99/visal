@extends('cp.contact.tab')
@section ('section-title', $contact->en_title.': Message')
@section ('tab-active-message', 'active')
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
		
	</script>
	
@endsection
@section ('tab-content')
	<br />
	<div class="row">
		<div class="col-md-12">
			
			
		</div>
	</div><!--.row-->
	<br />
	@if(sizeof($data) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
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
	                           		
	                           		<a href="{{ route($route.'.edit', ['detail_id'=>$row->id,'id'=>$id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		
	                           		
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