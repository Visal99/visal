<section class="">
    <div class="padd-t-b20"> 
      <div style="border-top: 1px solid #fdfdfd00;" class="page-header">
        <h1 style=""></h1>
      </div> 
      <div class="container citizen padd-t-b20">
        <div class="row">
          @php($citizen_services = $defaultData['citizen_services'])
          @foreach($citizen_services as $row)
          <div class="museum-block1 col-md-2 col-xs-6 padding-l-r">
              <div class="inner-box1">
                  <div class="icon-box1">
                       <a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>$row->slug]) }}"><img src="{{ asset ($row->icon)}}" class="img img-responsive margin_au"> </a>
                      <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>$row->slug]) }}">{{$row->title}}</a></h3>
                  </div>
              </div>
          </div>
          @endforeach
          <!-- <div class="museum-block1 col-md-2 col-xs-6 padding-l-r">
              <div class="inner-box1">
                  <div class="icon-box1">
                      <img src="{{ asset ('public/frontend/images/mpwt/automation/Technical_Inspection.png')}}" class="img img-responsive margin_au">
                      <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'technical-inspection']) }}">Driver License</a></h3>
                  </div>    
              </div>       
          </div>
        
          <div class="museum-block1 col-md-2 col-xs-6 padding-l-r">
              <div class="inner-box1">
                  <div class="icon-box1">
                      <img src="{{ asset ('public/frontend/images/mpwt/automation/Transport_Licensing.png')}}" class="img img-responsive margin_au">
                      <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'transport-licensing']) }}">Technical Inspection</a></h3> 
                  </div> 
              </div>
          </div>
        
          <div class="museum-block1 col-md-2 col-xs-6 padding-l-r">
              <div class="inner-box1">
                  <div class="icon-box1 automation">
                       <img src="{{ asset ('public/frontend/images/mpwt/automation/Driver_License.png')}}" class="img img-responsive margin_au">
                       <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'driver-license']) }}">Water Taxi</a></h3>
                  </div>
              </div>
          </div>

          <div class="museum-block1 col-md-2 col-xs-6 padding-l-r">
              <div class="inner-box1">
                  <div class="icon-box1">
                       <img src="{{ asset ('public/frontend/images/mpwt/automation/Transport_Licensing.png')}}" class="img img-responsive margin_au">
                       <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'transport-licensing']) }}">Train Service</a></h3>
                  </div>  
              </div>
          </div>
        
          <div class="museum-block1 col-md-2 col-xs-6 padding-l-r">
              <div class="inner-box1">
                  <div class="icon-box1 automation">
                       <img src="{{ asset ('public/frontend/images/mpwt/automation/Driver_License.png')}}" class="img img-responsive margin_au">
                       <h3><a href="{{ route('automation-systems', ['locale'=>$locale, 'category'=>'driver-license']) }}">Transport Licensing</a></h3>
                  </div>
              </div>
              
          </div> -->
        </div>
      </div>
    </div>
  </section>