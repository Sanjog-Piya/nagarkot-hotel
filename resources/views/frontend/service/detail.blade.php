   @extends('frontend.layouts.app')

@section('content')
        <div class="event">
                    <div class="white-header">
                        <div class="container">
                            <div class="white-breadcrumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>Services</p>
                                <i class="fas fa-angle-right"></i>
                                <p>{{$service->title}}</p>
                              
                                
                            
                            </div>
                        </div>
                    </div>
            <div class="event-img">
                <img src="{{ uploaded_asset($service->thumbnail_img) }}" alt="">
            </div>
            <div class="container">
  
                <div class="event-title">
                    {{$service->title}}
                </div>
                <div class="event-intro">
          
            <p>{!! $service->description !!}</p>

                </div>
             </div>
          
        </div>
        <!-- About End -->
     @endsection 