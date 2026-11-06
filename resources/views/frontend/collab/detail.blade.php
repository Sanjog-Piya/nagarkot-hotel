   @extends('frontend.layouts.app')

   <style type="text/css">
    .aiz-main-wrapper {
        min-height: initial !important;
}
</style>

@section('content')
        <!-- Page Header Start -->
        <div class="about-header">
            <div class="container">


                        <div class="about-breadcrumb">
                            <div class="section-title">
                                Collaboration
                            </div>
                            <div class="bread-crumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>Collaboration</p>
                                <i class="fas fa-angle-right"></i>
                                <p>{{$collab->title}}</p>
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        <div class="container">
           <div class="collab">
               <div class="collab-first">
                   <div class="collab-img">
                            <img src="{{ uploaded_asset($collab->thumbnail_img) }}" alt="">
                   </div>
                   <div class="collab-desc">
                      <p>{!! $collab->short_description !!}</p>
                   </div>
               </div>
        
            

           </div>
        </div>
        <!-- About End -->
     @endsection