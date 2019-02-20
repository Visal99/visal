@extends('cp.contact.main')
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
						
						<a class="nav-link @yield ('tab-active-edit')" onclick="window.location.href='{{ route('cp.contact.edit', $id) }}'" href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-user"></i> Overview
							</span>
						</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link @yield ('tab-active-message')" onclick="window.location.href='{{ route('cp.contact.message.index', $id) }}' " href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-paperclip"></i> Message
							</span>
						</a>
					</li>
					@if(count($children) > 0)
					<li class="nav-item">
						<a class="nav-link @yield ('tab-active-department')" onclick="window.location.href='{{ route('cp.contact.department.index', $id) }}' " href="#" role="tab" data-toggle="tab">
							<span class="nav-link-in">
								<i class="fa fa-building-o"></i> Sub Departments
							</span>
						</a>
					</li>
					@endif
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