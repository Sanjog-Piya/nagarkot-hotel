                <div class="single_product">
                    <div class="single_product_img">

                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                             alt="Product" class="img_fluid w-100">

                        <ul>
                            <li><a href="{{ route('product', $product->slug) }}"><i class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                        </ul>
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
                            View Detaisls
                            <span></span>
                        </a>
                    </div>
                </div>
