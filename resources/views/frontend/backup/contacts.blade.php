@extends('frontend/layouts.master')

@section('title', __('general.general-departments').' | '.__('general.welcome'))

@section ('appbottomjs')

@endsection

@section ('content')
  <!-- <div class="page_banner">
    <img src="{{ asset ('public/frontend/images/mpwt/banner/page_banner1.jpg')}}">
  </div> -->
    <div class="container">
        <div class="page-header ">
            <h1>{{ __('general.general-departments') }}</h1>
        </div>
        <div class="col-md-9 col-md-9 col-sm-12 col-xs-12">
          <div class="row sectin-cnt">
            <h4 class=""> <i class="fa fa-bank"></i> General Department of Administration</h4>
            <br />
            <table class="table table-bordered">
              <thead class="text-center">
                <tr> 
                  <td>Department</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="#" target="_blank">Notice on Operating System Automation for Motor Vehicle Registration</a></td>
                </tr>
                 
              </tbody>
            </table>
            <hr>
          </div>
        </div>

        <div class="clearfixed"></div>
          <!--Sidebar Side-->
        <div class="sidebar-side col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <aside class="sidebar">
            
            @include('frontend.sidebar.automation-systems')
            @include('frontend.sidebar.public-works')

          </aside>
        </div>
    </div>
@endsection