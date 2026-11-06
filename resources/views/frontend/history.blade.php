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
                                Our History
                            </div>
                            <div class="bread-crumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>Our History</p>
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="container">
            <div class="history">
                <div class="history-overview">
                    <p>{!! get_setting('h_tab') !!}</p>
                </div>
                <div class="history-main">
                    <ul>
                    	     @php $slider_images = json_decode(get_setting('history_imagenew'), true);  @endphp
                    	      @foreach ($slider_images as $key => $value)
                        <li>
                            <div class="history-left">
                                <div class="history-circle">
                                    <div class="history-inner-circle">

                                    </div>
                                </div>
                                <div class="history-date">
                                    {{ json_decode(get_setting('history_yearnew'), true)[$key] }} 
                                </div>
                            </div>
                            <div class="history-right">
                                <!--<img src="">-->
                                   <img src="{{ uploaded_asset($slider_images[$key]) }}" alt="">
                                <div class="history-right-text">
                                    <h4>History</h4>
                                    {{ json_decode(get_setting('history_descriptionnew'), true)[$key] }}
                                </div>
                            
                            </div>
                        </li>
                         @endforeach
    
                    </ul>
                </div>
            </div>
        </div>






@endsection