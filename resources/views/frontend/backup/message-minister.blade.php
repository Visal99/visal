@extends('frontend/layouts.master')

@section('title', __('general.about-us').' | '.__('general.welcome'))

@if($page == 'home')
@section('active-home', 'actives')
@else
@section('active-about', 'actives')
@endif

@section ('appbottomjs')

@endsection

@section ('content')
<style>
/* Popup container - can be anything you want */
.popup {
    position: relative;
}

/* The actual popup */
.popup .popuptext {
    visibility: hidden;
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
}
/* Popup arrow */
.popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
    from {opacity: 0;} 
    to {opacity: 1;}
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
}
</style>

    <div class="container padd-t-b" >
        <div class="page-header">
            <h1 class="font-i2 padding-left1">{{ __('web.message-from-the-minister') }} </h1>
        </div>
        <div class="inner-news paddingtop5px">
          <div class="top-mss font-i2">
            <div class="date-left">
              <span clas="mss-date float-left post-time3" style="color:#003399;">18 July 2018</span>
            </div>
            <div class="date-right2">
              <a href="mailto:info@mpwt.gov.kh"><span clas="mss-date float-left"><i class="fa fa-envelope"></i> Email</span></a>
              <a href="#" class="popup" onclick="myFunction()"><span class="popuptext" id="myPopup">Under Construction</span><span clas="mss-date float-right" style="float:right;"><i class="fa fa-print"></i> Print</span></a>
            </div>
          </div>
          <br>
          <hr>
          <div class="row padding15px">
            <!--<div class="col-md-5"><img src="@if(!empty($minister_message)){{ asset ( $minister_message->image )}}@endif"/></div>-->
            <div class="col-md-12 font-i2">
              <p><?php 
                              $content= $minister_message->content;
                              $result = substr($content, 0,2000);
                              echo $content; 
                            ?></p>
            </div>
            <div class="col-md-12 paddingtop20px font-i2 ">

            </div>
            <div class="col-md-12 padd-t-b wrap_share">
              <div class="col-md-12 no-paddding share2">
                <div class="col-md-4 no-paddding font-i2">
                  <span>Love to share on</span>
                </div>
                <div class="col-md-4 no-paddding font-i2">
                  <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fmpwt.gov.kh%2F&width=125&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId" width="125" height="25" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
                <div class="col-md-4 font-i2 paddingtop6px">
                  <div class="g-plus" data-action="share" data-height="24"></div>
                </div>
              </div>
            </div>
          </div>

        </div>

    </div>
    <br /> 

    <script>
    // When the user clicks on div, open the popup
   
    function myFunction() {
        window.print();
    }
    </script>
@endsection