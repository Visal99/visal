<div class="sidebar-widget popular-posts">
    <div class="page-header">
        <h1 class="text-center font-i">{{__('web.featured-post')}}</h1>
    </div>
    <div class="inner-news">
    @foreach($features as $row)    
    <article class="post">
        @php( $img = asset('public/frontend/images/1Mthanks.jpg'))
        @php( $featuredImage = $row->images()->select('img_url')->orderBy('data_order', 'ASC')->first() )
        @if($featuredImage)
            @php( $img = asset($featuredImage->img_url) )
        @endif
        <figure class="post-thumb"><a href="{{ route('news-detail', ['locale'=>$locale, 'id'=>$row->id]) }}"><img src="{{ $img }}" alt=""></a></figure>
        <div class="text font-i2"><a href="{{ route('news-detail', ['locale'=>$locale, 'id'=>$row->id]) }}">{{$row->title}} </a></div>
    </article>
    @endforeach 
    </div>  
</div>
                    