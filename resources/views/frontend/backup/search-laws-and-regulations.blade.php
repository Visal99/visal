@extends('frontend/layouts.master')

@section('title', 'Laws and Regulations | Ministry of Public Work And Transpotation')
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
      limit   = $('#limit').val();

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
    <div class="container">
        <div class="page-header">
            <h1>{{ __('general.laws-and-regulations') }}</h1>
        </div>
    </div>
  <div class="sidebar-page-container">
      <div class="auto-container">
          <div class="row clearfix">
              
                <!--Content Side-->
                <div class="content-side col-lg-9 col-md-8 col-sm-12 col-xs-12">
                  
                    <h4>{{ __('web.road-transportation') }}</h4>
                    <br />
                    
                      <div class="contact-form">
                       
                            <div class="row ">
                                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                    <select id="type" class="">
                                     
                                       <?php 
                                        $first='';
                                        $othersx='';

                                        $type=isset($_GET['type'])?$_GET['type']:0;
                                        foreach($types as $row){ 
                                          if($type==$row->id){
                                            $first='<option value="'.$row->id.'">'.$row->title.'</option>';
                                          }else{
                                            $othersx.='<option value="'.$row->id.'">'.$row->title.'</option>';
                                          }
                                        }
                                        echo $first.'<option value="0">Select Type</option>'.$othersx;
                                      ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                    <select id="category" class="">
                                     <?php 
                                      $first='';
                                      $othersx='';

                                      $category=isset($_GET['category'])?$_GET['category']:0;
                                      foreach($categories as $row){ 
                                        if($category==$row->id){
                                          $first='<option value="'.$row->id.'">'.$row->title.'</option>';
                                        }else{
                                          $othersx.='<option value="'.$row->id.'">'.$row->title.'</option>';
                                        }
                                      }
                                      echo $first.'<option value="0">Select Category</option>'.$othersx;
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="email" id="name" value="" placeholder="Title of document" required="">
                                </div>
                                <div class="form-group col-md-2 col-sm-6 col-xs-12">
                                    <button id="btn-search" type="submit" class="btn default-button blue-btn"><i class="fa fa-search"></i> Search</button>
                                </div>

                               

                            </div>
                        
                      </div>

                      <table class="table table-bordered">
                          <thead class="text-center">
                            <td>{{ __('web.no') }} </td>
                            <td>Category </td>
                            <td>Type </td>
                            <td style="width:12%">{{ __('web.date') }} </td>
                            
                            <td>{{ __('web.title') }} </td>
                            <td>{{ __('web.download') }} </td>
                          </thead>
                          <tbody>
                            @php ($i = 1)
                            @foreach($data as $row)
                              <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{$row->category}}</td>
                                <td>{{$row->type}}</td>
                                <td>{{ Carbon\Carbon::parse($row->created_at)->format('Y-M-d') }}</td>
                                <td><a href="#">{{$row->title}} </a></td>
                                <td  class="text-center"><a target="_blank" href="{{asset($row->pdf)}}"><i class="fa fa-download"></i> </a></td>
                              </tr>
                            @endforeach
                            
                          </tbody>
                      </table>
                    <div class="row">
            <div class="col-xs-12 col-sm-6">
              <fieldset class="form-group">
                  <label class="form-label" for="limit"><br /></label>
                  <select class="form-control" id="limit" name="limit" style="width:70px">
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
              </fieldset>
            </div>
            <div class="col-xs-12 col-sm-6 text-right">
              <br />
              {{ $data->links() }}


            </div>
          </div>
                </div>
                <!--End Content Side-->
                
                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-4 col-sm-8 col-xs-12">
                  <aside class="sidebar">
                      @include('frontend.sidebar.automation-systems')
                      @include('frontend.sidebar.public-works')
                  </aside>
                </div>
                <!--End Sidebar Side-->
                
            </div>
        </div>
    </div>
      
@endsection