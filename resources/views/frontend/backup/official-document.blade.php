@extends('frontend/layouts.master')

@section('title', __('general.official-document').' | '.__('general.welcome'))
@section('active-law', 'actives')

@section ('appbottomjs')
<script type="text/javascript">
    $(document).ready(function() {
      $("#btn-search").click(function(){
        search();
      })
    });
    function search(){
      name  = $('#name').val();
      category  = $('#category').val();
      type  = $('#type').val();
      limit   = 10;

      url="?limit="+limit;
      if(name!=""){
        url+='&name='+name;
      }
      if(category!=""){
        url+='&category='+category;
      }
      if(type!=""){
        url+='&type='+type;
      }
      
      $(location).attr('href', '{{ route('search-laws-and-regulations', ['locale'=>$locale]) }}'+url);
    }
  </script>
@endsection


@section ('content')
   
  <!-- <div class="page_banner">
    <img src="{{ asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')}}">
  </div> -->

  <div class="sidebar-page-container">
      <div class="container">
          <div class="row clearfix">
                <!--Content Side-->
                <div class="content-side col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.official-document') }}  </small></div>
                    <div class="page-header">
                      <h1 class="padding-left1 font-i">{{ __('general.official-document') }} </h1>
                    </div>
                   
                    <div class="inner-news">
                      @php($i = 1)
                    @foreach($documents as $row)
                    
                      <div class="@if($i++ ==1) upper-box19 @else upper-box11 @endif">
                            <h3><i class="@if($i==1)fa9 fa-angle-right9 @else fa fa-angle-right @endif " aria-hidden="true"></i><a target="_blank" href="{{ $row->google_link }}">{{ $row->title }}</a></h3>

                            <div class="post-time22">
                              <span class="post-type11">{{ __('web.type') }}: @foreach($document_types as $type) @if($row->type_id == $type->id) {{$type->title}} @endif  @endforeach</span>{{ Carbon\Carbon::parse($row->updated_at)->format('Y-M-d') }}
                            </div>
                      </div>
                    
                  @endforeach
                  </div>
                  <div class="text-center">
                    {{ $documents->links('vendor.pagination.frontend-html') }}
                  </div>

                </div>
                <!--End Content Side-->
                
                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-4 col-sm-8 col-xs-12 padd-t-b">
                  <aside class="sidebar">

                     <article class="">
                        <div class="page-header">
                            <h1 class="text-center font-i">{{ __('general.laws-and-regulations') }} </h1>
                        </div>
                        <div class="inner-news paddingtop5px">
                            <ul class="list-group font-i2">
                                @php($document_categories = $defaultData['document_categories'])
                                @php($i = 0)
                                @foreach($document_categories as $row)
                                <li class="list-group-item" @if($i++ == 0) style="border-top:none;" @endif ><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>$row->slug]) }}}"> <i class=""></i> {{$row->title}} </a></li>
                               @endforeach
                            </ul>
                        </div>
                    </article>
                  </aside>
                </div>
                <!--End Sidebar Side-->
                
            </div>
        </div>
    </div>
  @include('frontend.layouts.citizi-footer')    
@endsection