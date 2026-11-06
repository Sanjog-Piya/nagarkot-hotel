@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog.details', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')




        <!-- Page Header End -->
        <div class="container">
           <div class="blogs-single-page">
            
                       <div class="row">
                           <div class="col-md-8">
                                <div class="blogs-single-left">
                                    <div class="blogs-single-img">  
                                       <img
                src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                data-src="{{ uploaded_asset($blog->banner) }}"
                alt="{{ $blog->title }}"
                class="img-fluid lazyload w-100"
            >
                                    </div>
                                    <div class="blog-single-main">
                                        <div class="blog-single-share">
                                            <p>Share</p>
                                            <div class="aiz-share"></div>
                                        </div>
                                        <div class="blog-single-text">
                                            <h1 class="blog-single-title">
                                               {{ $blog->title }}
                                            </h1>
                                            <div class="blog-single-content">
                                                <p>  {!! $blog->description !!}</p>
        
                                            
                                            </div>
                                        </div>
                                    </div>  
                            </div>
                           </div>
                           <div class="col-md-4">
                            <div class="blog-single-right">
                                <div class="blogs-single-recent-title">
                                    Recent Blogs
                                </div>
                                <ul class="blogs-recent-list">

                                     @foreach($rblogs as $blog)
                                    <li>
                                        <a href="blog.html">
                                            <div class="blogs-recent-img">
                                                  <img
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($blog->banner) }}" 
                            alt="{{ $blog->title }}"
                            class="img-fluid lazyload "
                        >
                                            </div>
                                            <div class="blogs-recent-right">
                                                <div class="blogs-recent-title">
                                                      {{ $blog->title }}
                                                </div>
                                             
                                                <div class="blogs-recent-details">
                                                     <p><i class="fas fa-calendar-alt"></i> {{date('d F, Y', strtotime($blog->created_at))}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                  
                                </ul>
                            </div>
                           </div>
                       </div>

                 
                        
               
               </div>
           </div>
        </div>
        <!-- About End -->


@endsection


@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection