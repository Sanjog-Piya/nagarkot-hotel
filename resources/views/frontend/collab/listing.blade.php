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
                                Collaboration
                            </div>
                            <div class="bread-crumb">
                                <a href="Home">Home</a>
                                <i class="fas fa-angle-right"></i>
                                <p>Collaboration</p>
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <div class="container">
            <div class="collab-main">
                <div class="collab-main-subtitle">
                    We have always been working with important origanizations in improving both 
                    of our products to reach our goals and mission to revolutionize data in nepal
                </div>

                <div class="collaborators">

                    @foreach($collabs as $collab)
                    <a href="{{ url("collaboration").'/'. $collab->slug }}" class="">
                        <div class="collaborators-card">
                            <div class="collaborators-img">
                                   <img src="{{ uploaded_asset($collab->thumbnail_img) }}" alt="">
                            </div>
                            <div class="collaborators-name">{{ $collab->title }}</div>
                               <div class="collaborators-name">{{ $collab->collab_link }}</div>
                        </div>
                    </a>
                    @endforeach
                  
                </div>
            </div>
        </div>
@endsection
