@extends('frontend.layouts.app')

<style type="text/css">
	.aiz-main-wrapper{
		min-height: initial !important;
	}
</style>

@section('content')

        <!-- Page Header Start -->
        <div class="about-header">
            <div class="container">


                        <div class="about-breadcrumb">
                            <div class="section-title">
                                Our Team
                            </div>
                            <div class="bread-crumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>Our Team</p>
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        <div class="container">
        
           @php $slider_images = json_decode(get_setting('teamimage'), true);  @endphp 
            
           <div class="team-grid">
           	    @foreach ($slider_images as $key => $value)
               <div class="team-card">
                   <div class="team-img">
                     <img src="{{ uploaded_asset($slider_images[$key]) }}" alt="">
                   </div>
                   <div class="team-name">
                       {{ json_decode(get_setting('teamtitle'), true)[$key] }}
                   </div>
                   <div class="team-expertise">{{ json_decode(get_setting('teamposition'), true)[$key] }}</div>
                   <div class="team-intro">
                   {{ json_decode(get_setting('teampara'), true)[$key] }}
                   </div>
               </div>
                      @endforeach
           </div>
    
        </div>
        <!-- About End --> 


@endsection

