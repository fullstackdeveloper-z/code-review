<div class="right_sidebar_ad">
    <ul class="list-unstyled">

        @forelse (getAds('side') as $ad)
        @if ($ad->type =='side')
            @if ($ad->adable_type=='App\Models\Photo')
            <li>
            <a href="{{$ad->url }}"  target="_blank">
                <img class="img-fluid" src="{{ asset('storage/'.$ad->image->image) }}" alt="First slide" ></a>
            </li>
            @else
            <li>
                <a href="{{$ad->url }}"  target="_blank">
                    <video class="video" muted autoplay="autoplay" loop="loop" preload="auto" height="auto" width="100%">
                        <source src="{{ asset('storage/'.$ad->video->video) }}"></source>
                    </video>
                </a>
            </li>
            @endif
        @endif
        @empty
        <li>
            <img class="img-fluid" src="{{ asset('frontend/img/new_ad.png') }}" alt="image">
        </li>
        @endforelse

    </ul>
</div>
