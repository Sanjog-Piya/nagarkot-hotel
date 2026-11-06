 <section class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 d-none d-lg-block">
                    <ul class="topbar_info d-flex flex-wrap">
                        <li>
                            <a href="callto:tel:+92 318 7267755"><i class="fas fa-phone-alt"></i> tel:+92 318 7267755</a>
                        </li>
                        <li>
                            <a href="mailto:company@gmail.com"><i class="fas fa-envelope-open-text"></i>
                                info@fridayfarmfresh.com</a>
                        </li>
                        <li>
                            <p><i class="fas fa-map-marker-alt"></i> Japan</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="topbar_right d-flex flex-wrap align-items-center justify-content-end">
                        <ul class="topbar_icon d-flex flex-wrap">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        TOPBAR END
    ==========================-->


    <!--=========================
        HEADER START
    ==========================-->
    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="header_logo_area">
                        <a href="{{route('home')}}" class="header_logo">
                            <img src="https://fridayfarmfresh.com/storage/logo/img-8661.jpg" alt="Freshmat" class="img-fluid w-100">
                        </a>
                        <div class="mobile_menu_icon d-block d-lg-none" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <span class="mobile_menu_icon"><i class="far fa-stream menu_icon_bar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <form action="{{ route('search') }}" method="GET" class="stop-propagation w-100">
                        <input type="text" class="border-0 border-lg form-control" id="search" name="keyword" @isset($query)
                                        value="{{ $query }}"
                                    @endisset placeholder="{{translate('Search for fresh products..')}}" autocomplete="off">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                       <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
            style="min-height: 200px">
            <div class="search-preloader absolute-top-center">
                <div class="dot-loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="search-nothing d-none p-3 text-center fs-16">

            </div>
            <div id="search-content" class="text-left">

            </div>
        </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="header_support">
                        <span class="icon"><i class="fas fa-headset"></i></span>
                        <h3>
                            92 318 7267755
                            <span>24/7 Support Center</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
        <nav class="main_menu d-none d-lg-block mt-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="menu_category_bar">
                        <p>
                           
                            Browse Categories
                        </p>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <ul class="menu_cat_item show_home toggle_menu">
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
                <div class="col-xl-9 col-lg-9">
                    <ul class="menu_item">
                        <li class="relative_li">
                            <a class="active" href="{{route('home')}}">home </a>
                           
                        </li>
                            <li class="relative_li">
                            <a href="{{route('aboutus')}}">About Us </a>
                           
                        </li>

                        <li><a href="{{route('contact.index')}}">Contact</a></li>
                    </ul>
                    <ul class="menu_icon">
                        <!--<li><a data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"-->
                        <!--        aria-controls="offcanvasRight"><i class="far fa-shopping-basket"></i> <span>2</span></a>-->
                        <!--</li>-->
                           <li class="nav-cart-box dropdown h-100 ml-2 mr-2" id="cart_items">
                                        @include('frontend.partials.cart')
                                    </li>
                        <li><a href="{{ route('wishlists.index') }}"><i class="far fa-heart"></i></a></li>
                        
               
                        
                        <li>
                                       @auth
            @if(isAdmin())
                            
                            <a href="{{ route('admin.dashboard') }}"><i class="far fa-user"></i></a>
                            
                              @else
                              
                                                          <a href="{{ route('dashboard') }}"><i class="far fa-user"></i></a>
                                                          
                                                            @endif

            @else
            <a href="{{ route('user.login') }}">
              <i class="far fa-user"></i>
            </a>
            @endauth

                              
                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav> 

    <!--=========================
        MENU END
    ==========================-->


    <!--============================
        MOBILE MENU START
    ==============================-->
