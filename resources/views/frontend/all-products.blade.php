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
                                Products
                            </div>
                            <div class="bread-crumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>Products</p>
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

<section class="pb-4">
    <div class="container">
        <div class="card-columns blog-columns product-columns">
            @foreach($products as $product)


                <!-- normal -->
             <div class="card mb-3 overflow-hidden shadow-sm blog-card">
                    <a href="{{ url("product").'/'. $product->slug }}" class="text-reset d-block blog-card-img">
                        <img
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($product->thumbnail_img) }}" 
                            alt="{{ $product->title }}"
                            class="img-fluid lazyload "
                        >
                    </a>
                    <div class="p-4">
                        <h2 class="fs-18 fw-600 mb-1">
                            <a href="{{ url("product").'/'. $product->slug }}" class="text-reset">
                                {{ $product->name }}
                            </a>
                        </h2>
                     
                        <p class="opacity-70 mb-4">
                            {!! $product->short_description !!}
                        </p>
                        <a href="{{ url("product").'/'. $product->slug }}" class="btn btn-soft-primary">
                            {{ translate('View More') }}
                        </a>
                    </div>
                </div>
          
                     
            @endforeach 
            
        </div>
      
    </div>
</section>
@endsection
