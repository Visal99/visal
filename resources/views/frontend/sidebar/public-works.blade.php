<article class="">
    <div class="page-header">
        <h1 class="text-center font-i">{{ __('general.public-works') }}</h1>
    </div>
    <div class="inner-news paddingtop5px">
        <ul class="list-group font-i2">
            @php($public_works = $defaultData['public_works'])
            @foreach($public_works as $row)
            <li class="list-group-item" @if($row->id == 1) style="border-top:0px solid;" @endif><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>$row->slug]) }}"> <i class=""></i> {{ $row->title}} </a></li>
            @endforeach
           <!--  <li class="list-group-item"><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'sewage-systems']) }}"> <i class=""></i> {{ __('general.sewage-systems') }} </a></li>
            <li class="list-group-item"><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'road-infrastructure']) }}"> <i class=""></i>{{ __('general.road-infrastructure') }} </a></li>
            <li class="list-group-item"><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'public-works-technical']) }}"> <i class=""></i> {{ __('general.public-works-technical') }} </a></li>
            <li class="list-group-item"><a href="{{ route('public-works', ['locale'=>$locale, 'category'=>'road-map']) }}"> <i class=""></i> {{ __('general.road-map') }} </a></li> -->
        </ul>
    </div>
</article>
