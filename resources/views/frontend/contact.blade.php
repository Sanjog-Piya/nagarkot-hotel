@extends('frontend.layouts.app')

<style type="text/css">
    .aiz-main-wrapper {
        min-height: initial !important;
}
</style>
@section('content')

   <div class="contact pt-5">
         <div class="container">
             <div class="section_heading mb_35">
                        <h4>Get In Touch</h4>
                        <h2>Contact Us</h2>
                    </div>
             <div class="contact-box">
                 <div class="row justify-content-center">
                     <div class="col-md-8">
                         <div class="contact-form">
                            <form action="{{ route('contact.store') }}" method="POST">@csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">

                                      <input type="text" class="form-control" name="fname" id="contactFirst" placeholder="First Name">
                                    </div>
                                    <div class="form-group col-md-6">

                                      <input type="text" class="form-control" name="lname" id="contactLast" placeholder="Last Name">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-6">

                                        <input type="email" class="form-control" name="email" id="contactEmail" placeholder="Email">
                                      </div>
                                      <div class="form-group col-md-6">

                                        <input type="number" class="form-control" name="number" id="contactPhone" placeholder="Contact Number">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                 
                                    <textarea class="form-control" id="contactMessage" name="message" rows="3" placeholder="Message"></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-primary content-submit">Submit</button>

                            </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>


@endsection