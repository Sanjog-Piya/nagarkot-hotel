@if(get_setting('home_categories') != null) 
    @php $home_categories = json_decode(get_setting('home_categories')); @endphp
    @foreach ($home_categories as $key => $value)
        @php $category = \App\Models\Category::find($value); @endphp
        <section class="mb-4">
            <div class="container">
                <div class=" bg-white shadow-sm rounded">
                    <div class="d-flex mb-3 align-items-baseline">
                        <h3 class="h5 fw-700 mb-0">
                            <span class=" pb-3 d-inline-block">{{ $category->getTranslation('name') }}</span>
                        </h3>
                        <a href="{{ route('products.category', $category->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                    </div>
                    <div class="row">
                        @foreach (get_cached_products($category->id) as $key => $product)
                       <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                        @include('frontend.partials.product_box_1',['product' => $product])
                    </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endif

