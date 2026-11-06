@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency" content="{{ \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')
    <section class="mb-4 pt-3">
        <div class="container">
            <div class="bg-white shadow-sm rounded p-3 product-detailed-container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-4">
                        <div class=" z-3 row gutters-10">
                            @php
                                $photos = explode(',', $detailedProduct->photos);
                            @endphp
                            <div class="col order-1 order-md-2"> 
                                <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true'>
                                    @foreach ($photos as $key => $photo)
                                        <div class="carousel-box img-zoom rounded">
                                            <img
                                                class="img-fluid lazyload" style="width: 100%;"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </div>
                                    @endforeach
                                    @foreach ($detailedProduct->stocks as $key => $stock)
                                        @if ($stock->image != null)
                                            <div class="carousel-box img-zoom rounded">
                                                <img
                                                    class="img-fluid lazyload"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($stock->image) }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 col-md-auto w-md-80px order-2 order-md-1 mt-3 mt-md-0">
                                <div class="aiz-carousel product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-vertical-sm='false' data-focus-select='true' data-arrows='true'>
                                    @foreach ($photos as $key => $photo)
                                    <div class="carousel-box c-pointer border p-1 rounded">
                                        <img
                                            class="lazyload mw-100 size-50px mx-auto"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($photo) }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                        >
                                    </div>
                                    @endforeach
                                    @foreach ($detailedProduct->stocks as $key => $stock)
                                        @if ($stock->image != null)
                                            <div class="carousel-box c-pointer border p-1 rounded" data-variation="{{ $stock->variant }}">
                                                <img
                                                    class="lazyload mw-100 size-50px mx-auto"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($stock->image) }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                            <div class="product_guarantee mt-2">
                                            <div class="row">
              
                 
     
            </div>
                            </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 position-relative">

                   

                        <div class="text-left product_det_text">
                            <h1 class="mb-2 details_title text-dark single-product-name">
                                {{ $detailedProduct->name }}
                            </h1>

                            <div class="row align-items-center">
                                <div class="col-12">
                                    @php
                                        $total = 0;
                                        $total += $detailedProduct->reviews->count();
                                    @endphp
                                    <span class="rating">
                                        {{ renderStarRating($detailedProduct->rating) }}
                                    </span>
                                    <span class="ml-1 opacity-50">({{ $total }} {{ translate('reviews')}})</span>
                                </div>
                                @if ($detailedProduct->est_shipping_days)
                                <div class="col-auto ml">
                                    <small class="mr-2 opacity-50">{{ translate('Estimate Shipping Time')}}: </small>{{ $detailedProduct->est_shipping_days }} {{  translate('Days') }}
                                </div>
                                @endif
                            </div>


                            <div class="row align-items-center">
             

                                @if ($detailedProduct->brand != null)
                                    <div class="col-auto">
                                        <a href="{{ route('products.brand',$detailedProduct->brand->slug) }}">
                                            <img src="{{ uploaded_asset($detailedProduct->brand->logo) }}" loading="lazy" alt="{{ $detailedProduct->brand->getTranslation('name') }}" height="30">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            
                                  <div class="row no-gutters details_short_description mt-3" style="    flex-direction: column;">
                                    <div class="col-sm-2">
                                        <h3 class="opacity-50 my-2">{{ translate('Description')}}:</h3>
                                    </div>
                                    
                                    <p>Green Peas are small, round legumes with a slightly sweet flavour and tender texture. They are commonly used in soups, stews, curries, salads, and side dishes. Their versatility allows them to be incorporated into both hot and cold recipes, adding a natural taste, vibrant colour, and pleasant texture to a variety of meals.

</p>
                                    
                                    </div>

                            

                            @if ($detailedProduct->wholesale_product)
                                <table class="aiz-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ translate('Min Qty') }}</th>
                                            <th>{{ translate('Max Qty') }}</th>
                                            <th>{{ translate('Unit Price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailedProduct->stocks->first()->wholesalePrices as $wholesalePrice)
                                            <tr>
                                                <td>{{ $wholesalePrice->min_qty }}</td>
                                                <td>{{ $wholesalePrice->max_qty }}</td>
                                                <td>{{ single_price($wholesalePrice->price) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                @if(home_price($detailedProduct) != home_discounted_price($detailedProduct))
                                    <div class="row no-gutters mt-3">
                                        <div class="col-sm-2">
                                            <div class="opacity-50 my-2">{{ translate('Price')}}:</div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="fs-20 opacity-60">
                                                <del>
                                                    {{ home_price($detailedProduct) }}
                                                    @if($detailedProduct->unit != null)
                                                        <span>/ KG</span>
                                                    @endif
                                                </del>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row no-gutters my-2">
                                        <div class="col-sm-2">
                                            <div class="opacity-50">{{ translate('Discount Price')}}:</div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="product-detailed-price">
                                                <strong class="h2 fw-600 text-primary ">
                                                    {{ home_discounted_price($detailedProduct) }}
                                                </strong>
                                                @if($detailedProduct->unit != null)
                                                    <span class="opacity-70">/ KG</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row no-gutters details_short_description mt-3" style="    flex-direction: column;">
                                        <div class="col-sm-2 ">
                                            <h3 class="opacity-50 my-2">{{ translate('Price')}}:</h3>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="product-detailed-price">
                                                <strong class="h2 fw-600 text-primary">
                                                    {{ home_discounted_price($detailedProduct) }}
                                                </strong>
                                                @if($detailedProduct->unit != null)
                                                    <span class="opacity-70">/ KG</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                <div class="row no-gutters mt-4">
                                    <div class="col-sm-2">
                                        <div class="opacity-50 my-2">{{  translate('Club Point') }}:</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="d-inline-block rounded px-2 bg-soft-primary border-soft-primary border">
                                            <span class="strong-700">{{ $detailedProduct->earn_point }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <hr>

                            <form id="option-choice-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                                @if ($detailedProduct->choice_options != null)
                                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

                                    <div class="row no-gutters">
                                        <div class="col-sm-2">
                                            <div class="opacity-50 my-2">{{ \App\Models\Attribute::find($choice->attribute_id)->getTranslation('name') }}:</div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="aiz-radio-inline">
                                                @foreach ($choice->values as $key => $value)
                                                <label class="aiz-megabox pl-0 mr-2">
                                                    <input
                                                        type="radio"
                                                        name="attribute_id_{{ $choice->attribute_id }}"
                                                        value="{{ $value }}"
                                                        @if($key == 0) checked @endif
                                                    >
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2">
                                                        {{ $value }}
                                                    </span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                @endif

                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="row no-gutters">
                                        <div class="col-sm-2">
                                            <div class="opacity-50 my-2">{{ translate('Color')}}:</div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="aiz-radio-inline">
                                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Models\Color::where('code', $color)->first()->name }}">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="{{ \App\Models\Color::where('code', $color)->first()->name }}"
                                                        @if($key == 0) checked @endif
                                                    >
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: {{ $color }};"></span>
                                                    </span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                @endif

                                <!-- Quantity + Add to cart -->
                                <div class="row no-gutters details_short_description" style="    flex-direction: column;">
                                    <div class="col-sm-2">
                                        <h3 class="opacity-50 my-2">{{ translate('Quantity')}}:</h3>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                                <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" disabled="">
                                                    <i class="las la-minus"></i>
                                                </button>
                                                <input type="number" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="10">
                                                <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>
                                            @php
                                                $qty = 0;
                                                foreach ($detailedProduct->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            @endphp
                                            <div class="avialable-amount opacity-60">
                                                @if($detailedProduct->stock_visibility_state == 'quantity')
                                                (<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})
                                                @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                                    (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                
   

                                <div class="row no-gutters pb-3 d-none details_short_description" style="    flex-direction: column;" id="chosen_price_div">
                                    <div class="col-sm-3">
                                        <h3 class="opacity-50 my-2">{{ translate('Total Price')}}:</h3>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="product-price">
                                            <strong id="chosen_price" class="h4 fw-600 text-primary">

                                            </strong>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="mt-3 d-flex">
                                @if ($detailedProduct->external_link != null)
                                    <a type="button" class="btn btn-primary buy-now fw-600" href="{{ $detailedProduct->external_link }}">
                                        <i class="la la-share"></i> {{ translate($detailedProduct->external_link_btn)}}
                                    </a> 
                                @else
                                    <button type="button" class="btn btn-soft-primary mr-2 add-to-cart fw-600" style="width:50%;     background: #05a845;" onclick="addToCart()">
                                        <span class=" d-md-inline-block text-white"> {{ translate('Add to cart')}}</span>
                                    </button>
                                  
                                @endif
                                <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                                    <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}}
                                </button>
                            </div>



                     


                            @php
                                $refund_sticker = get_setting('refund_sticker');
                            @endphp
                            @if (addon_is_activated('refund_request'))
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="opacity-50 mt-2">{{ translate('Refund')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <a href="{{ route('returnpolicy') }}" target="_blank"> 
                                            @if ($refund_sticker != null) 
                                                <img src="{{ uploaded_asset($refund_sticker) }}" loading="lazy" height="36"> 
                                            @else 
                                                <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" loading="lazy" height="36"> 
                                            @endif</a>
                                        <a href="{{ route('returnpolicy') }}" class="ml-2" target="_blank">{{ translate('View Policy') }}</a>
                                    </div>
                                </div>
                            @endif
                            <div class="row no-gutters mt-4">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Share')}}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="aiz-share"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                 <div class="col-xl-4 col-md-6 d-none d-xl-block wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="shop_details_banner">
                        <img src="https://html.narzotech.com/freshmat/images/details_banner_img.png" alt="banner" class="img-fluid w-100">
                        <div class="text">
                            <h4>Daily Offer</h4>
                            <h3>Fresh Organic Food Up To 65% Off</h3>
                            <a class="common_btn" href="https://fresh.cakesewa.com/category/fresh--Organic-Nv2lQ">shop now <i class="fas fa-long-arrow-right" aria-hidden="true"></i>
                                <span></span></a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container">
            <div class="row gutters-10">
            
                <div class="col-xl-12 order-0 order-xl-1">
                    <div class="bg-white mb-3 shadow-sm rounded">
                        <div class="nav border-bottom aiz-nav-tabs product-details-tabs">
                            <a href="#tab_default_1" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset active show">{{ translate('Description')}}</a>
                            @if($detailedProduct->video_link != null)
                                <a href="#tab_default_2" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Video')}}</a>
                            @endif
                            @if($detailedProduct->pdf != null)
                                <a href="#tab_default_3" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Downloads')}}</a>
                            @endif
                                <a href="#tab_default_4" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Reviews')}}</a>
                        </div>

                        <div class="tab-content pt-0">
                            <div class="tab-pane fade active show" id="tab_default_1">
                                <div class="p-4">
                                    <div class="mw-100 overflow-hidden text-left aiz-editor-data">
                                        <?php echo $detailedProduct->description ?>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab_default_2">
                                <div class="p-4">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                            <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                            <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_default_3">
                                <div class="p-4 text-center ">
                                    <a href="{{ uploaded_asset($detailedProduct->pdf) }}" class="btn btn-primary">{{  translate('Download') }}</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_default_4">
                                <div class="p-4">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($detailedProduct->reviews as $key => $review)
                                            @if($review->user != null)
                                            <li class="media list-group-item d-flex">
                                                <span class="avatar avatar-md mr-3">
                                                    <img
                                                        class="lazyload"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                        @if($review->user->avatar_original !=null)
                                                            data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                        @else
                                                            data-src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        @endif
                                                    >
                                                </span>
                                                <div class="media-body text-left">
                                                    <div class="d-flex justify-content-between">
                                                        <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}</h3>
                                                        <span class="rating rating-sm">
                                                            @for ($i=0; $i < $review->rating; $i++)
                                                                <i class="las la-star active"></i>
                                                            @endfor
                                                            @for ($i=0; $i < 5-$review->rating; $i++)
                                                                <i class="las la-star"></i>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <div class="opacity-60 mb-2">{{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                                                    <p class="comment-text">
                                                        {{ $review->comment }}
                                                    </p>
                                                </div>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    @if(count($detailedProduct->reviews) <= 0)
                                        <div class="text-center fs-18 opacity-70">
                                            {{  translate('There have been no reviews for this product yet.') }}
                                        </div>
                                    @endif

                                    @if(Auth::check())
                                        @php
                                            $commentable = false;
                                        @endphp
                                        @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                            @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Models\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                @php
                                                    $commentable = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                     
                                    @endif
                                      @if(Auth::user())
                                        <div class="mainhereputreview">
                                            <div class=" mb-2 mainwrite">
                                                <h3 class="fs-17 fw-600">
                                                    {{ translate('Write a review')}}
                                                </h3>
                                            </div>
                                            <form class="form-default mainform" role="form"
                                                  action="{{ route('reviews.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id"
                                                       value="{{ $detailedProduct->id }}">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for=""
                                                                   class="text-uppercase c-gray-light">{{ translate('Your name')}}</label>
                                                            <input type="text" name="name"
                                                                   value="{{ Auth::user()->name }}"
                                                                   class="form-control" disabled required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for=""
                                                                   class="text-uppercase c-gray-light">{{ translate('Email')}}</label>
                                                            <input type="text" name="email"
                                                                   value="{{ Auth::user()->email }}"
                                                                   class="form-control" required disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="opacity-60">{{ translate('Rating')}}</label>
                                                    <div class="rating rating-input">
                                                        <label>
                                                            <input type="radio" name="rating" value="1" required>
                                                            <i class="las la-star"></i>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="rating" value="2">
                                                            <i class="las la-star"></i>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="rating" value="3">
                                                            <i class="las la-star"></i>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="rating" value="4">
                                                            <i class="las la-star"></i>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="rating" value="5">
                                                            <i class="las la-star"></i>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="opacity-60">{{ translate('Comment')}}</label>
                                                    <textarea class="form-control" rows="4" name="comment"
                                                              placeholder="{{ translate('Your review')}}"
                                                              required></textarea>
                                                </div>

                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary mt-3">
                                                        {{ translate('Submit review')}}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="loginpadds">
                                            <a href="#" class="loginCart">Please <span>login</span> to give a review
                                                about this product.</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-white rounded shadow-sm">
                       <div class="section-title">
                Related Products
            </div>
                        <div class="p-3">
                            <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="4" data-lg-items="4"  data-md-items="4" data-sm-items="3" data-xs-items="2" data-arrows='true' data-infinite='true'>
                                @foreach (filter_products(\App\Models\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                        <div class="">
                                            <a href="{{ route('product', $related_product->slug) }}" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($related_product->thumbnail_img) }}"
                                                    alt="{{ $related_product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">

                                            <div class="fs-15">
                                                @if(home_base_price($related_product) != home_discounted_base_price($related_product))
                                                    <del class="fw-600 opacity-50 mr-1">{{ home_base_price($related_product) }}</del>
                                                @endif
                                                <span class="fw-700 text-primary">{{ home_discounted_base_price($related_product) }}</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                {{ renderStarRating($related_product->rating) }}
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                <a href="{{ route('product', $related_product->slug) }}" class="d-block text-reset">{{ $related_product->getTranslation('name') }}</a>
                                            </h3>
                                            @if (addon_is_activated('club_point'))
                                                <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                                    {{ translate('Club Point') }}:
                                                    <span class="fw-700 float-right">{{ $related_product->earn_point }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('modal')
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600" data-dismiss="modal">{{ translate('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (addon_is_activated('otp_system'))
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                                @if (addon_is_activated('otp_system'))
                                    <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                            </div>
                        </form>

                        <div class="text-center mb-3">
                            <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                            <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                        </div>
                        @if(get_setting('google_login') == 1 ||
                            get_setting('facebook_login') == 1 ||
                            get_setting('twitter_login') == 1)
                            <div class="separator mb-3">
                                <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                            </div>
                            <ul class="list-inline social colored text-center mb-5">
                                @if (get_setting('facebook_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(get_setting('google_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                            <i class="lab la-google"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (get_setting('twitter_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            getVariantPrice();
        });

        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }
        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }

            function valueChanged()
    {
        if($('#flexCheckChecked').is(":checked"))   
            $(".caketext").show();
        else
            $(".caketext").hide();
    }



    </script>
@endsection
