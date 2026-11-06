@extends('frontend.layouts.app')

@section('content')

<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Services')}}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">
                            {{ translate('Home')}}
                        </a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset">
                            "{{ translate('Services') }}"
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

        <!-- Page Header End -->
        <div class="services">
            <div class="container">
                <div class="service-main-grid">

                	@foreach($services as $service)

   <a href="{{ url("service").'/'. $service->slug }}" class="text-reset d-block">
                    <div class="service-card">
                        <div class="service-card-img">
                             <img
                                        src="{{ uploaded_asset($service->thumbnail_img) }}"
                                        data-src="{{ uploaded_asset($service->thumbnail_img) }}"
                                        alt="{{ $service->title }}"
                                        
                                    >
                        </div>
                        <div class="service-card-title">
                            {{ $service->title }}
                        </div>
                        <div class="service-card-intro">
                           {!! $service->short_description !!}
                        </div>
                    </div>
                </a>

                    @endforeach

                
             
                </div>
               
            </div>
        </div>
        <!-- About End -->

@endsection
