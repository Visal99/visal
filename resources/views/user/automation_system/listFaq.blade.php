@extends('user/layouts.app')

@section('title', 'Update Automation System')
@section('active-main-menu-automation-system', 'opened')
@section ('appheadercss')
	<link href="{{ asset ('public/user/css/plugin/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset ('public/user/css/plugin/fileinput/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
	<!-- some CSS styling changes and overrides -->
	<style>
		.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
		    margin: 0;
		    padding: 0;
		    border: none;
		    box-shadow: none;
		    text-align: center;
		}
		.kv-avatar .file-input {
		    display: table-cell;
		    max-width: 220px;
		}
	</style>
@endsection

@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/user/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/user/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection

@section ('appbottomjs')
	<script type="text/JavaScript">
		$(document).ready(function(event){
		
			$('#form').validate({
				modules : 'file',
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			}); 
			$('#form').submit(function(event){
				event.prevenDefault();
				alert('This is form submit.');
			})

		}); 
		function change_feature(){
			val 	= $('#feature').val();
			if(val == 0){
				$('#feature').val(1);
			}else{
				$('#feature').val(0);
			}
		}

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
				        url: "{{ route('user.automation-system.order-faq',$data->id) }}",
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

	

	<script>
		
		var btnCust = ''; 
		$("#image").fileinput({
		    overwriteInitial: true,
		    maxFileSize: 1500,
		    showClose: false,
		    showCaption: false,
		    showBrowse: false,
		    browseOnZoneClick: true,
		    removeLabel: '',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-2',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="{{ asset ($data->image) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be (100-500)cmX(100-500)cm with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
	<script>
		
		var btnCust = ''; 
		$("#icon").fileinput({
		    overwriteInitial: true,
		    maxFileSize: 1500,
		    showClose: false,
		    showCaption: false,
		    showBrowse: false,
		    browseOnZoneClick: true,
		    removeLabel: '',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-2',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="{{ asset ($data->icon) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be (100-500)cmX(100-500)cm with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
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
						<a href="{{ route('user.automation-system.list') }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-arrow-left"></span></a>
						<a href="{{ route('user.automation-system.create-faq', $data->id) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span> Add New Faq</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
			<div class="box-typical box-typical-padding">
					
				<div class="container-fluid">
					<section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-icons">
					<div class="tbl">
						<ul class="nav" role="tablist">
							<li class="nav-item">
								<a class="nav-link" onclick="window.location.href='{{ route('user.automation-system.edit', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<i class="fa fa-info"></i>
										Information
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" onclick="window.location.href='{{ route('user.automation-system.list-location', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-flag"></span>
										Location
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " onclick="window.location.href='{{ route('user.automation-system.list-video', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-home"></span>
										Video
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" onclick="window.location.href='{{ route('user.automation-system.list-manual', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-bookmark"></span>
										Manual
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " onclick="window.location.href='{{ route('user.automation-system.list-document', ['id'=>$data->id,'slug'=>$data->slug]) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-file"></span>
										Regulation
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" onclick="window.location.href='{{ route('user.automation-system.list-faq', $data->id) }}'" href="#" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<span class="glyphicon glyphicon-pencil"></span>
										Faq
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
											<th>Updated Date</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										@php ($i = 1)
										@foreach ($faqs as $row)
										
											<tr id="element-{{ $row->id }}" data-id="{{ $row->id }}" class="moveable" feature-order="{{ $row->featured_order }}" draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)" ondragend="dragend(event)">
												<td>{{ $i++ }}</td>
												<td>{{ $row->en_title }}</td>
												
												<td>{{ $row->updated_at }}</td>
												 
												<td style="white-space: nowrap; width: 1%;">
													<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
			                                           	<div class="btn-group btn-group-sm" style="float: none;">
			                                           		<a href="{{ route('user.automation-system.edit-faq', ['automation_system_id'=>$data->id,'id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
			                                           		<a href="#" onclick="deleteConfirm('{{ route('user.automation-system.trash-faq', $row->id) }}', '{{ route('user.automation-system.list-faq',$data->id) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
			                                           		
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