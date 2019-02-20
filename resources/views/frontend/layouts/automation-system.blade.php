@if(isset($defaultData['publicServices']))  
  <section class="">
    <div class="padd-t-b20"> 
      <div style="border-top: 1px solid #fdfdfd00;" class="page-header">
        <h1 style=""></h1>
      </div> 
      <div class="container citizen padd-t-b20">
        <div class="row">
          @php($publicServices = $defaultData['publicServices'])
          @foreach($publicServices as $row)
          <div class="museum-block1 col-md-2 col-xs-6 padding-l-r">
           
              <div class="en_ser_b inner-box1">
                  <div class="icon-box1">
                      <a href="{{ route('public-services', ['locale'=>$locale, 'slug'=>$row->slug]) }}">
                        <img src="{{ asset ($row->icon)}}" class="img img-responsive margin_au"> 
                      </a>
                      <h3>
                        <a href="{{ route('public-services', ['locale'=>$locale, 'slug'=>$row->slug]) }}">{{$row->title}}</a>
                      </h3>
                  </div>
              </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif