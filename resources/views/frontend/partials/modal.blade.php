<script>
    function confirm_modal(delete_url)
    {
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                <h4 class="modal-title" id="myModalLabel">{{ translate('Confirmation')}}</h4>
            </div>

            <div class="modal-body">
                <p>{{ translate('Delete confirmation message')}}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ translate('Cancel')}}</button>
                <a id="delete_link" class="btn btn-danger btn-ok">{{ translate('Delete')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade filter-box" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content advance-search-box">
      <div class="modal-header text-left">
        <h4 class="modal-title" id="myModalLabel">Search Your Cake even faster!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="c-search" method="get" action="{{ route('advance.search') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="highest_price" value="{{$maxPrice}}">
            <div class="row justify-content-center">
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 align-self-end">
                    <label for="formGroupExampleInput" class="text-center">I'm looking for</label>
                    <input type="text" name="q" class="form-control" id="formGroupExampleInput" placeholder="Cake name">
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 align-self-end">
                    <label for="formGroupSearchCategory" class="text-center">Select Category</label>
                    <select class="custom-select mr-sm-2" name="category" id="formGroupSearchCategory" required autocomplete="off">
                        <option value=""> All Category</option>
                        @php
                          $allCategoriees = \App\Models\Category::where('level',0)->get();
                        @endphp
                        @if(isset($allCategoriees))
                        @foreach($allCategoriees as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 align-self-end">
                    <label for="formGroupSearchCategory" class="text-center">Select Brand</label>
                    <select class="custom-select mr-sm-2" name="brand" id="formGroupSearchCategory" autocomplete="off">
                        <option value=""> All Brand</option>
                        @php
                          $allCategoriees = \App\Models\Brand::get();
                        @endphp
                        @if(isset($allCategoriees))
                        @foreach($allCategoriees as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 align-self-end">
                    <label for="formGroupSearchPrice" class="text-center">Price Range</label>
                    <select class="custom-select mr-sm-2" name="price" id="formGroupSearchPrice">
                        <option selected> All </option>
                        <option value="1">Rs00.00-Rs10,000</option>
                        <option value="2">Rs10,000-Rs20,000</option>
                        <option value="3">Rs20,000-Rs40,000</option>
                        <option value="4">Rs40,000-Rs60,000</option>
                        <option value="5">Above Rs60,000</option>
                    </select>

                </div>
                <!-- <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-6 col-12 align-self-end">
                    <label for="formGroupColorSelect" class="text-center">Select Color</label>
                    <select class="custom-select mr-sm-2" id="formGroupColorSelect">
                        <option selected>Black</option>
                        <option value="1">Red</option>
                        <option value="2">Blue</option>
                        <option value="3">Green</option>
                    </select>

                </div> -->
                <div class="col-lg-1 col-12 col-md-6 col-sm-6 col-xs-6 search-btn-advanced align-self-end">


                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Search</button>
        </form>



    </div>
  </div>
</div>
</div>