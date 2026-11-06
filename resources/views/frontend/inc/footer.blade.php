<footer class="mt_180 xs_mt_140">
    <div class="footer_overlay">
        <div class="container">

            <div class="footer_info"
                 style="background: url('{{ static_asset('assets/images/footer_info_bg.jpg') }}');">
                <div class="row wow fadeInUp">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer_info_item">
                            <div class="icon">
                                <img src="https://fridayfarmfresh.com/storage/logo/img-8661.jpg"
                                     alt="Icon" class="img-fluid w-100">
                            </div>
                            <div class="text">
                                <h3>Free Shipping</h3>
                                <p>Worldwide</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="footer_info_item">
                            <div class="icon">
                                <img src="{{ static_asset('assets/images/footer_info_icon_2.png') }}"
                                     alt="Icon" class="img-fluid w-100">
                            </div>
                            <div class="text">
                                <h3>Helpline</h3>
                                <p>+1256 25632 565</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="footer_info_item">
                            <div class="icon">
                                <img src="{{ static_asset('assets/images/footer_info_icon_3.png') }}"
                                     alt="Icon" class="img-fluid w-100">
                            </div>
                            <div class="text">
                                <h3>24/7 Support</h3>
                                <p>Free For Customers</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="footer_info_item">
                            <div class="icon">
                                <img src="{{ static_asset('assets/images/footer_info_icon_4.png') }}"
                                     alt="Icon" class="img-fluid w-100">
                            </div>
                            <div class="text">
                                <h3>Returns</h3>
                                <p>30 Days Free Exchanges</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-8">
                    <div class="footer_logo_area">
                        <a class="footer_logo" href="index-2.html">
                            <img src="https://fridayfarmfresh.com/storage/logo/img-8661.jpg"
                                 alt="Worldwide EBS" class="img-fluid w-100">
                        </a>
<p>
At Friday Farm Fresh, we bring you farm-picked fruits, vegetables, dairy, and daily essentials delivered straight to your doorstep. We focus on freshness, quality, and fair pricing, ensuring every product meets the highest standards. Shop with confidence and enjoy healthy living made simple.
</p>
                      
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 col-md-4">
                    <div class="footer_link">
                        <h3>Category</h3>
                        <ul>
                            @foreach($categories as $cat)
                            <li><a href="{{route('products.category',$cat->slug)}}">{{$cat->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
 
                <div class="col-lg-2 col-sm-6 col-md-4">
                    <div class="footer_link">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li>                            <a href="{{route('aboutus')}}">About Us </a>
</li>
                            <li><a href="{{route('contact.index')}}">Contact</a></li>
                            <!--<li><a href="{{route('blog')}}">Recent Blogs</a></li>-->
                        </ul>
                    </div>
                </div> 

           

                <div class="col-lg-2 col-sm-6 col-md-4">
                    <div class="footer_link footer_logo_area">
                        <h3>Contact</h3>
                        <span><a class="ml-0" href="mailto:worldwideebs@gmail.com">worldwideebs@gmail.com</a></span>
                        <ul>
                            <li><span>Follow :</span></li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-tiktok"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="footer_copyright mt_75">
                        <p>Copyright @ Worldwideebs 2026. All right reserved.</p>
                        <ul>
                            <li>Payment by :</li>
                            <li>
                                <img src="{{ static_asset('assets/images/footer_payment_icon_1.jpg') }}"
                                     alt="payment" class="img-fluid w-100">
                            </li>
                            <li>
                                <img src="{{ static_asset('assets/images/footer_payment_icon_2.jpg') }}"
                                     alt="payment" class="img-fluid w-100">
                            </li>
                            <li>
                                <img src="{{ static_asset('assets/images/footer_payment_icon_3.jpg') }}"
                                     alt="payment" class="img-fluid w-100">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
