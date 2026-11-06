@extends('frontend.layouts.app')

<style type="text/css">
    .aiz-main-wrapper {
        min-height: initial !important;
}
</style>

@section('content')

        <div class="about-header">
            <div class="container">


                        <div class="about-breadcrumb">
                            <div class="section-title">
                                News
                            </div>
                            <div class="bread-crumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>News</p>
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

<section class="pb-4">
    <div class="container">
        <div class="card-columns blog-columns">
            @foreach($blogs as $key => $blog)
           <!--  {{$key}} -->
           <!--   @if($key == 2 || $key == 6)
                <div class="card mb-3 overflow-hidden shadow-sm blog-card">
                  
                    <div class="p-4">
                       <h2>Add here</h2>
                    </div>
                </div>
                @endif -->

                <!-- normal -->
             <div class="card mb-3 overflow-hidden shadow-sm blog-card">
                    <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset d-block blog-card-img">
                        <img
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($blog->banner) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid lazyload "
                        >
                    </a>
                    <div class="p-4">
                        <h2 class="fs-18 fw-600 mb-1">
                            <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset">
                                {{ $blog->title }}
                            </a>
                        </h2>
                        @if($blog->category != null)
                        <div class="mb-2 opacity-50">
                            <i>{{ $blog->category->category_name }}</i>
                        </div>
                        @endif
                        <p class="opacity-70 mb-4">
                            {{ $blog->short_description }}
                        </p>
                        <a href="{{ url("blog").'/'. $blog->slug }}" class="btn btn-soft-primary">
                            {{ translate('View More') }}
                        </a>
                    </div>
                </div>
          
                     
            @endforeach 
            
        </div>
        <div class="aiz-pagination aiz-pagination-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</section>
@endsection
