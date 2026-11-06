@extends('frontend.layouts.app')

@section('content')

<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Events')}}</h1>
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
                            "{{ translate('Events') }}"
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="pb-4 event-main">
    <div class="container">
        <div class="card-columns">
            @foreach($events as $event)
                <div class="card mb-3 overflow-hidden shadow-sm">
               <a href="{{ url("event").'/'. $event->slug }}" class="text-reset d-block">
                                    <img
                                        src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                        data-src="{{ uploaded_asset($event->thumbnail_img) }}"
                                        alt="{{ $event->title }}"
                                        class="img-fluid lazyload event-main-img"
                                    >
                                </a>
                    <div class="event-main-content">
                        <h2 class="fs-18 fw-600 mb-1">
                            <a href="{{ url("event").'/'. $event->slug }}" class="text-reset event-main-title">
                                {{ $event->title }}
                            </a>
                        </h2>
                       
                        <p class="opacity-70 mb-4">
                            {{ $event->short_description }}
                        </p>
                        <p class="event-date"> <i class="fas fa-calendar-alt"></i>{{date('d F, Y', strtotime($event->date))}}</p>
                        <a href="{{ url("event").'/'. $event->slug }}" class="btn btn-soft-primary event-main-button">
                            {{ translate('View More') }}
                        </a>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</section>
@endsection
