@extends('user.contact.main')
@section ('section-css')
	@yield ('tab-css')
@endsection

@section ('section-js')
	@yield ('tab-js')
@endsection

@section ('section-content')
		
			
	<section class="tabs-section">
		<div class="tabs-section-nav tabs-section-nav-icons">
			<div class="tbl">
				<ul class="nav" role="tablist">
					<li class="nav-item">
						<a class="nav-link @yield ('tab-active-edit')" onclick="window.location.href='{{ route( $route.'.edit', ['contact_id'=> $contact->id, 'department_id'=> $department_id ]) }}'" href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								Overview
							</span>
						</a>
					</li>
	
					<li class="nav-item">
						<a class="nav-link @yield ('tab-active-message')" onclick="window.location.href='{{ route( $route.'.message', ['contact_id'=> $contact->id, 'department_id'=> $department_id ]) }}' " href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								Message
							</span>
						</a>
					</li>
					
				</ul>
			</div>
		</div><!--.tabs-section-nav-->

		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active">
				<div id="tab-content-cnt" class="container-fluid">
					@yield ('tab-content')
				</div>
			</div>
		</div><!--.tab-content-->
	</section><!--.tabs-section-->
				
	


@endsection