@extends('frontend.layouts.app')

<style type="text/css">
	.aiz-main-wrapper{
		min-height: initial !important;
	}
</style>

@section('content')

        <div class="about-header">
            <div class="container">
                        <div class="about-breadcrumb">
                            <div class="section-title">
                               Join Our team
                            </div>
                            <div class="bread-crumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>Join Our Team</p>
                                
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="join">
            <div class="container">
                <div class="join-subtitle">
                    Dots and Dashes requires highly skilled personnel for the efficient and 
                    quality job to be done in humanitarian response data and information. So we 
                    seek CV from people who are not only skilled but also has the urge to imporve themnselves
                     with the organization and be eager to follow by the organization rules and policy.
                </div>
                <div class="join-box">
                    <div class="join-box-top">
                        <div class="join-logo">
                            <img src="{{ static_asset('assets/img/logo-white.png') }}" alt="">
                        </div>

                    </div>
                    <div class="join-box-content">
                        <p>Please Note: Fill the google form for applying for the team</p>
                        <ul class="join-box-pos">
                        	@foreach($joins as $join)
                            <li>
                                <h4>{{$join->title}} <a href="">(Application Form)</a></h4>
                                   <p class="join-box-date">
                                    <i class="fas fa-calendar-alt"></i>  March 3, 2021
                                </p>
                              
                                    <p>{!! $join->short_description !!}</p>
                             
                            </li>
             				@endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>


@endsection