<section class="top_ad_panal">
    <div class="container">
        <ul class="list-inline add_top_sec">
            @forelse (getAds('top') as $ad)
            @if ($ad->type =='top')
                @if ($ad->adable_type=='App\Models\Photo')
                <li class="list-inline-item">
                    <div class="ad_img1">
                    <a href="{{$ad->url }}">
                        <img class="img-fluid" src="{{ asset('storage/'.$ad->image->image) }}" alt="image">
                        </a>
                    </div>
                </li>
                @else
                <li class="">
                    <div class="list-inline-item">
                        <a href="{{$ad->url }}" target="_blank">
                          <video class="video_cl" src="{{ asset('storage/'.$ad->video->video) }}" muted autoplay loop playsinline  height="133px" width="100%"></video>
                        </a>
                    </div>
                </li>
                @endif
            @endif
            @empty
            @endforelse
        </ul>
    </div>
</section>
