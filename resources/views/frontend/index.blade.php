@extends('frontend.layouts.app')

@section('content')

     <section class="banner">
        <div class="container">
            <div class="row">
<div class="col-lg-3 d-none d-lg-block">
    <ul class="menu_cat_item">

        @foreach(\App\Models\Category::where('level', 0)->orderBy('order_level','desc')->get() as $category)
        <li>
            <a href="{{ route('products.category', $category->slug) }}">
                <!--<span>-->
                <!--    <img src="{{ uploaded_asset($category->icon) }}"-->
                <!--         onerror="this.onerror=null;this.src='{{ static_asset('assets/images/category_placeholder.png') }}';"-->
                <!--         alt="{{ $category->getTranslation('name') }}">-->
                <!--</span>-->
                {{ $category->getTranslation('name') }}
            </a>

            @php
                $children = \App\Models\Category::where('parent_id',$category->id)->get();
            @endphp

            @if($children->count() > 0)
            <ul class="menu_cat_droapdown">
                @foreach($children as $child)
                <li>
                    <a href="{{ route('products.category', $child->slug) }}">
                        {{ $child->getTranslation('name') }}

                        @php
                            $subchildren = \App\Models\Category::where('parent_id',$child->id)->get();
                        @endphp

                        @if($subchildren->count() > 0)
                            <i class="fas fa-angle-right"></i>
                        @endif
                    </a>

                    @if($subchildren->count() > 0)
                    <ul class="sub_category">
                        @foreach($subchildren as $sub)
                        <li>
                            <a href="{{ route('products.category', $sub->slug) }}">
                                {{ $sub->getTranslation('name') }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                </li>
                @endforeach
            </ul>
            @endif

        </li>
        @endforeach

        <li class="all_category">
            <a href="{{ route('categories.all') }}">
                View All Categories <i class="far fa-arrow-right"></i>
            </a>
        </li>

    </ul>
</div>
                <div class="col-lg-9">
                    <div class="banner_content">
<div class="row banner_slider">
    @foreach ($banners as $banner)
        <div class="col-xl-12">
            <div class="single_slider"
                 style="background: url('{{ uploaded_asset($banner->thumbnail_img) }}');">
                 
                <div class="single_slider_text wow fadeInDown">
                    <h3>Organic 100% Genuine Product</h3>
                    <h1>Tasty & <span>Healthy</span> Organic Food</h1>
                    <p>Contrary to popular belief, Lorem Ipsum is not random text classical
                        Latin literature.</p>
                    <a class="common_btn" href="https://fresh.cakesewa.com/category/fresh--Organic-Nv2lQ">
                        shop now <i class="fas fa-long-arrow-right"></i> <span></span>
                    </a>
                </div>

            </div>
        </div>
    @endforeach
</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        BANNER END
    ==========================-->


    <!--=========================
        CATEGORIES START
    ==========================-->
<section class="categories pt_100 xs_pt_80">
    <div class="container">
        <div class="slider_padding">
            <div class="row category_slider">

                @foreach ($categories as $key => $category)
                    <div class="">
                        <a href="{{route('products.category', $category->slug)}}"
                           class="category_item color_{{ ($key % 7) + 1 }} wow fadeInUp">

                            <div class="icon">
                                <img src="{{ uploaded_asset($category->icon) }}"
                                     alt="category"
                                     class="img-fluid w-100">
                            </div>

                            <h4>{{ $category->name }}</h4>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
    <!--=========================
        CATEGORIES END
    ==========================-->


    <!--=========================
        ADD BANNER START
    ==========================-->
    <section class="add_banner pt_75 xs_pt_55">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="add_banner_item wow fadeInUp" style="background: url({{static_asset('assets/images/banner_bg_1.jpg')}});">
                        <div class="add_banner_item_text wow fadeInLeft">
                            <h4>Black Friday Offer</h4>
                            <h2>Organic Foods Up To 45% Off</h2>
                            <a class="common_btn" href="https://fresh.cakesewa.com/category/fresh--Organic-Nv2lQ">shop now <i
                                    class="fas fa-long-arrow-right"></i>
                                <span></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="add_banner_item wow fadeInUp" style="background: url({{static_asset('assets/images/banner_bg_2.jpg')}});">
                        <div class="add_banner_item_text wow fadeInLeft">
                            <h4>Daily Offer</h4>
                            <h2>Vegetables Up To 65% Off</h2>
                            <a class="common_btn bg_blck" href="https://fresh.cakesewa.com/category/fresh--Organic-Nv2lQ">shop now <i
                                    class="fas fa-long-arrow-right"></i>
                                <span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        ADD BANNER END
    ==========================-->


    <!--=========================
        FRESH PRODUCTS START
    ==========================-->
    <section class="fresh_products pt_95 xs_pt_75">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-5 m-auto">
                    <div class="section_heading mb_35">
                        <h4>Our Products</h4>
                        <h2>Our Fresh Products</h2>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp">
<div class="col-12">
    <div class="row">

        @foreach ($products as $product)
            <div class="col-xl-3 col-sm-6 col-lg-4">
                <div class="single_product">
                    <div class="single_product_img">

                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                             alt="Product" class="img_fluid w-100">

                      
                    </div>

                    <div class="single_product_text">
                        <a class="title" href="{{ route('product', $product->slug) }}">
                            {{ $product->name }}
                        </a>

                        <p>
                          {{ home_discounted_base_price($product) }}
                           @if(home_base_price($product) != home_discounted_base_price($product))
                <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>
            @endif
                        </p>

                        <a class="cart_btn"
                           href="{{ route('product', $product->slug) }}"
                           data-bs-toggle="modal"
                           data-bs-target="#cart_popup_modal">
                            <i class="far fa-eye"></i>
                            View Detail
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
            </div>
        </div>
    </section>

    <div class="cart_popup_modal">
        <div class="modal fade" id="cart_popup_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-md-6">
                                <div class="cart_popup_modal_img">
                                    <img src="{{static_asset('assets/images/home2_product_img_4.jpg')}}" alt="Product img-fluid w-100">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="product_det_text">
                                    <h2 class="details_title">Nestle Nescafe Classic Instant</h2>
                                    <p class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                        <span>Review (20)</span>
                                    </p>
                                    <p class="price">$10.50 <del>$12.00</del></p>
                                    <div class="details_quentity_area">
                                        <p><span>Qti Weight</span> (in kg) :</p>
                                        <div class="button_area">
                                            <button>-</button>
                                            <input type="text" placeholder="01">
                                            <button>+</button>
                                        </div>
                                        <h3>= $10.50</h3>
                                    </div>
                                    <div class="details_cart_btn">
                                        <a class="common_btn" href="#"><i class="far fa-shopping-basket"></i>
                                            View Detail
                                            <span></span></a>
                                        <a class="love" href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                    <p class="category"><span>Category:</span>Coffee</p>
                                    <ul class="tags">
                                        <li>Tags:</li>
                                        <li><a href="#">Black Coffee, </a></li>
                                        <li><a href="#">Popular,</a></li>
                                        <li><a href="#">Top Sell</a></li>
                                    </ul>
                                    <ul class="share">
                                        <li>Share with friends:</li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=========================
        FRESH PRODUCTS END
    ==========================-->


    <!--=========================
        COUNTDOWN START
    ==========================-->
    <section class="countdown mt_100 xs_mt_80 pt_95 xs_pt_75 pb_95 xs_pb_75"
        style="background: url({{static_asset('assets/images/countdown_bg.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-md-9 col-lg-6 col-xl-6">
                    <div class="countdown_text wow fadeInLeft">
                        <div class="section_heading heading_left">
                            <h4>Sales on Weekly Offers</h4>
                            <h2>Our special products deal of the day</h2>
                        </div>
                        <p>There are many variations of passages of Lorem Ipsum available butmajority have suffered
                            alteration in some form.</p>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="https://fresh.cakesewa.com/category/fresh--Organic-Nv2lQ">shop now <i class="fas fa-long-arrow-right"></i>
                            <span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        COUNTDOWN END
    ==========================-->


    <!--=========================
        BEST SELL START
    ==========================-->
    <section class="best_sell mt_100 xs_mt_80">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="section_heading heading_left mb_25 wow fadeInLeft">
                        <h4>Best Sells Products</h4>
                        <h2>Organic Bestseller Product</h2>
                    </div>
                </div>
            </div>
<div class="row">
    <!-- LEFT BANNER (static image stays same) -->
    <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInLeft">
        <div class="special_product_banner">
            <img src="{{ static_asset('assets/images/special_pro_banner_img_3.jpg') }}"
                 alt="special product" class="img-fluid w-100">
            <div class="text">
                <h5>Organic Food</h5>
                <h3>Fresh Foods Up To 45% Off</h3>
                <a class="common_btn" href="https://fresh.cakesewa.com/category/fresh--Organic-Nv2lQ">
                    shop now <i class="fas fa-long-arrow-right"></i>
                    <span></span>
                </a>
            </div>
        </div>
    </div>

    <!-- RIGHT PRODUCTS -->
    <div class="col-xl-9 col-md-6 col-lg-8 wow fadeInUp">
        <div class="row best_sell_slider">

            @foreach ($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="single_product wow fadeInUp">
                        <div class="single_product_img">

                            <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                 alt="Product" class="img_fluid w-100">

                          
                        </div> 

                        <div class="single_product_text">
                            <a class="title" href="{{ route('product', $product->slug) }}">
                                {{ $product->name }}
                            </a>

                            <p>
                          {{ home_discounted_base_price($product) }}
                           @if(home_base_price($product) != home_discounted_base_price($product))
                <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>
            @endif
                        </p>


                            <a class="cart_btn"
                               href="{{ route('product', $product->slug) }}"
                               data-bs-toggle="modal"
                               data-bs-target="#cart_popup_modal">
                                <i class="far fa-eye"></i> View Detail
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
        </div>
    </section>
    <!--=========================
        BEST SELL END
    ==========================-->


    <!--=========================
        BRAND START
    ==========================-->
    <!--=========================
        BRAND END
    ==========================-->


    <!--=========================
        SPECIAL PRODUCT START
    ==========================-->
    <section class="special_product pt_95 xs_pt_75">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-5 m-auto">
                    <div class="section_heading mb_25">
                        <h4>Special Products</h4>
                        <h2>Our Special Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-4 col-lg-3 col-xl-3">
                    <div class="special_product_banner wow fadeInLeft">
                        <img src="{{static_asset('assets/images/special_pro_banner_img.jpg')}}" alt="special product" class="img-fluid w-100">
                        <div class="text">
                            <h5>Weekly Discounts on</h5>
                            <h3>Fruits and Vegetables</h3>
                            <p>It is a long established fact that a reader
                                acted by the readable content.</p>
                            <a class="common_btn black_btn" href="https://fresh.cakesewa.com/category/fresh--Organic-Nv2lQ">shop now <i
                                    class="fas fa-long-arrow-right"></i>
                                <span></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-lg-9 col-xl-9">
<div class="row">
    @foreach ($products as $product)
        <div class="col-md-6">
            <div class="special_product_item wow fadeInUp">

                <div class="special_product_img">
                    <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                         alt="product" class="img-fluid w-100">

                    @if($product->discount > 0)
                        <span class="discount">save {{ $product->discount }}%</span>
                    @endif
                </div>

                <div class="special_product_text">
                    <a class="title" href="{{ route('product', $product->slug) }}">
                        {{ $product->name }}
                    </a>

                    <span>
                        @for($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= round($product->rating) ? 'fas fa-star' : 'far fa-star' }}"></i>
                        @endfor
                    </span>

                    <p>
                          {{ home_discounted_base_price($product) }}
                           @if(home_base_price($product) != home_discounted_base_price($product))
                <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>
            @endif
                        </p>

                </div>

            </div>
        </div>
    @endforeach
</div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        SPECIAL PRODUCT END
    ==========================-->


    <!--=========================
        FARMING START
    ==========================-->
    <section class="farming mt_100 xs_mt_80 pt_75 xs_pt_60 pb_100 xs_pb_80"
        style="background: url({{static_asset('assets/images/farming_bg.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-10">
                    <div class="farming_text wow fadeInLeft">
                        <div class="section_heading heading_left">
                            <h4>New Tech Farming</h4>
                            <h2>Watch Our Farming And Cultivations</h2>
                        </div>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which slightly
                            believable.</p>
                        <a class="common_btn" href="#">Read more <i class="fas fa-long-arrow-right"></i>
                            <span></span></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="farming_img wow fadeInUp">
                                <img src="{{static_asset('assets/images/farming_img_1.jpg')}}" alt="farming" class="img-fluid w-100">
                                <div class="overlay">
                                    <a class="venobox play_btn" data-autoplay="true" data-vbtype="video"
                                        href="https://youtu.be/nqye02H_H6I?si=Yq79QYJhfIT_wkC_">
                                        <i class=" fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6">
                            <div class="farming_img wow fadeInUp">
                                <img src="{{static_asset('assets/images/farming_img_2.jpg')}}" alt="farming" class="img-fluid w-100">
                                <div class="overlay">
                                    <a class="venobox play_btn" data-autoplay="true" data-vbtype="video"
                                        href="https://youtu.be/nqye02H_H6I?si=Yq79QYJhfIT_wkC_">
                                        <i class=" fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6">
                            <div class="farming_img wow fadeInUp">
                                <img src="{{static_asset('assets/images/farming_img_3.jpg')}}" alt="farming" class="img-fluid w-100">
                                <div class="overlay">
                                    <a class="venobox play_btn" data-autoplay="true" data-vbtype="video"
                                        href="https://youtu.be/nqye02H_H6I?si=Yq79QYJhfIT_wkC_">
                                        <i class=" fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6">
                            <div class="farming_img wow fadeInUp">
                                <img src="{{static_asset('assets/images/farming_img_4.jpg')}}" alt="farming" class="img-fluid w-100">
                                <div class="overlay">
                                    <a class="venobox play_btn" data-autoplay="true" data-vbtype="video"
                                        href="https://youtu.be/nqye02H_H6I?si=Yq79QYJhfIT_wkC_">
                                        <i class=" fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        FARMING END
    ==========================-->


    <!--=========================
        DOWNLOAD START
    ==========================-->
    <!--=========================
        DOWNLOAD END
    ==========================-->


    <!--=========================
        TESTIMONIAL START
    ==========================-->
<section class="testimonial pt_95 xs_pt_75 pb_140 xs_pb_100" style="background: url({{static_asset('assets/images/testimonial_bg.jpg')}});">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-xl-5 m-auto">
                <div class="section_heading mb_50 text-center">
                    <h4>Testimonials</h4>
                    <h2>What Our Customers Say</h2>
                </div>
            </div>
        </div>

        <div class="row testi_slider">

            <!-- Testimonial 1 -->
            <div class="col-xl-4">
                <div class="testimonial_item wow fadeInUp">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>5.0</span>
                    </p>
                    <p class="review_text">
                        The vegetables were incredibly fresh and neatly packed. 
                        Delivery was right on time, and everything tasted just like shopping at a local Japanese market. 
                        Highly recommended!
                    </p>
                    <div class="testimonial_footer">
                        <div class="img">
                            <img src="{{static_asset('assets/images/testimonial_img_1.jpg')}}" alt="testimonial" class="img-fluid w-100">
                        </div>
                        <div class="text">
                            <h3>Haruto Tanaka</h3>
                            <p>Tokyo, Japan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="col-xl-4">
                <div class="testimonial_item wow fadeInUp">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span>4.5</span>
                    </p>
                    <p class="review_text">
                        I love ordering fresh seafood and fruits from here. 
                        Everything arrives chilled and clean. 
                        It saves me so much time after work. Great service!
                    </p>
                    <div class="testimonial_footer">
                        <div class="img">
                            <img src="{{static_asset('assets/images/testimonial_img_2.jpg')}}" alt="testimonial" class="img-fluid w-100">
                        </div>
                        <div class="text">
                            <h3>Aiko Sato</h3>
                            <p>Osaka, Japan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="col-xl-4">
                <div class="testimonial_item wow fadeInUp">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>4.0</span>
                    </p>
                    <p class="review_text">
                        Very reliable grocery delivery service. 
                        The Japanese bento meals are delicious and always fresh. 
                        Customer support is polite and helpful too.
                    </p>
                    <div class="testimonial_footer">
                        <div class="img">
                            <img src="{{static_asset('assets/images/testimonial_img_3.jpg')}}" alt="testimonial" class="img-fluid w-100">
                        </div>
                        <div class="text">
                            <h3>Kenji Nakamura</h3>
                            <p>Yokohama, Japan</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
    <!--=========================
        TESTIMONIAL END
    ==========================-->


    <!--=========================
        BLOG START
    ==========================-->




@endsection

@section('script')

        <script>
      var swiper = new Swiper(".mySwiper", {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>




@endsection