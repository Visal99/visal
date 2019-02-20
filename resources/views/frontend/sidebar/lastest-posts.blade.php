<div class="sidebar-widget popular-posts">
    <div class="page-header">
        <h1 class="text-center font-i">{{__('general.related-article')}}</h1>
    </div>
    @php($related_press = $defaultData['related_press'])
    
    <div class="inner-news">
    @foreach($related_press as $row)
     @php($category = 'public')
    <article class="post">
        <figure class="post-thumb"><a href="{{ route('press-view', ['locale'=>$locale, 'category'=>$row->category, 'slug'=>$row->slug]) }}"><img src="{{ asset ($row->image)}}" alt=""></a></figure>
        <div class="text font-i2"><a href="{{ route('press-view', ['locale'=>$locale, 'category'=>$row->category, 'slug'=>$row->slug]) }}">{{$row->title}} </a></div>
        <div class="post-info">{{ Carbon\Carbon::parse($row->updated_at)->format('Y-M-d') }}</div>
    </article>
    @endforeach 
    </div>  
</div>
                    