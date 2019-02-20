@extends('frontend/layouts.master')

@section('title', __('general.laws-and-regulations').' | '.__('general.welcome'))
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
                <div class="col-md-12">
                    <div class="breadcrumd"><small>{{ __('general.home') }} / {{ __('general.laws-and-regulations') }} @if(!empty($page_name))/ {{$page_name}} @endif  </small></div>
                </div>
                <div class="content-side col-md-8 col-sm-12 col-xs-12">
                    <div class="page-header">
                      <h1 class="padding-left1 font-i">@if(!empty($page_name)) {{$page_name}} @endif </h1>
                    </div>
                    <!-- <div class="inner-news">
                      <h4 class="">{{ __('web.road-transportation') }}</h4>
                      <br />
                      
                        <div class="contact-form">
                          
                              <div class="row ">
                                  <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                      <select id="type" class="">
                                        <option>{{ __('web.select-type') }}</option>
                                        @foreach($types as $row)
                                        <option value="{{$row->id}}">{{$row->title}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                      <select id="category" class="">
                                        <option value="0">{{ __('web.select-categories') }}</option>
                                        @foreach($categories as $row)
                                        <option value="{{$row->id}}" >{{$row->title}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                      <input type="text" name="email" id="name" value="" placeholder="{{ __('web.title-of-document') }}" required="">
                                  </div>
                                  <div class="form-group col-md-2 col-sm-6 col-xs-12">
                                      <button id="btn-search" type="submit" class=" btn default-button blue-btn"><i class="fa fa-search"></i> {{ __('web.search') }}</button>
                                  </div>

                                 

                              </div>
                         
                        </div>

                        <table class="table table-bordered">
                            <thead class="text-center">
                              <td>{{ __('web.no') }} </td>
                              <td style="width:12%">{{ __('web.category') }} </td>
                              <td style="width:12%">{{ __('web.date') }} </td>
                              
                              <td>{{ __('web.title') }} </td>
                              <td>{{ __('web.download') }} </td>
                            </thead>
                            <tbody>
                              @if(sizeof($documents) > 0)
                                @php ($i = 1)
                                @foreach($documents as $row)
                                  <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$data->title}}</td>
                                    <td>{{ $row->created_at->format('d-M-Y') }}</td>
                                    <td><a href="#">{{$row->title}} </a></td>
                                    <td  class="text-center"><a target="_blank" href="{{asset($row->pdf)}}"><i class="fa fa-download"></i> </a></td>
                                  </tr>
                                @endforeach
                              @else
                              <span>No Data</span>
                              @endif
                            </tbody>
                        </table>
                    </div> -->
                    <div class="inner-news">
                    @foreach($documents as $row)
                    
                      <div class="@if($i++ ==1) upper-box19 @else upper-box11 @endif">
                            <h3><i class="@if($i==1)fa9 fa-angle-right9 @else fa fa-angle-right @endif " aria-hidden="true"></i><a target="_blank" href="{{ $row->google_link }}">{{ $row->title }}</a></h3>

                            <div class="post-time22">
                              <span class="post-type11">{{ __('web.type') }}: @if(!empty($page_name)) {{$page_name}} @endif</span>{{ Carbon\Carbon::parse($row->updated_at)->format('Y-M-d') }}
                            </div>
                      </div>
                    
                  @endforeach
                  </div>
                  {{ $documents->links('vendor.pagination.frontend-html') }}

                </div>
                <!--End Content Side-->
                
                <!--Sidebar Side-->
                <div class="sidebar-side col-md-4 col-sm-8 col-xs-12">
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
                                <li class="list-group-item" @if($i++ == 0) style="border-top:none;" @endif ><a href="{{ route('laws-and-regulations', ['locale'=>$locale, 'category'=>$row->slug]) }}"> <i class=""></i> {{$row->title}} </a></li>
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