   @extends('frontend.layouts.app')

@section('content')
        <div class="event">
                    <div class="white-header">
                        <div class="container">
                            <div class="white-breadcrumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>Events</p>
                                <i class="fas fa-angle-right"></i>
                                <p>{{$event->title}}</p>
                              
                                
                            
                            </div>
                        </div>
                    </div>
            <div class="event-img">
                <img src="{{ uploaded_asset($event->thumbnail_img) }}" alt="">
            </div>
            <div class="container">
                <div class="event-details">
                    <ul class="event-time">
                        <li>
                            <i class="far fa-calendar-alt"></i>
                            <span>{{date('d F, Y', strtotime($event->date))}}</span>
                        </li>
                        
                    </ul>
                    <div class="event-venue">
                        <p>Venue</p>
                        <span>{{$event->venue}}</span>
                    </div>
                </div>
                <div class="event-title">
                    {{$event->title}}
                </div>
                <div class="event-intro">
          
            <p>{!! $event->description !!}</p>

                </div>
             </div>
          
        </div>
        <!-- About End -->
     @endsection 