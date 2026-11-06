        @extends('backend.layouts.app')
@section('content')

        {{-- Home Slider --}}
            <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Our History') }}</h6>
            </div>
            <div class="card-body">
              <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                 <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('History Description')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="h_tab">
                                <textarea type="text" name="h_tab" class="form-control aiz-text-editor" >{{  get_setting('h_tab') }}</textarea>
                            
                            </div>
                        </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>


                    <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('All History ') }}</h6>
            </div>
        <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ translate('All History') }}</label>
                        <div class="home-banner1-target">
                            <input type="hidden" name="types[]" value="history_yearnew">
                            <input type="hidden" name="types[]" value="history_descriptionnew"> 
                            @if (get_setting('history_yearnew') != null)
                                @foreach (json_decode(get_setting('history_yearnew'), true) as $key => $value)
                                    <div class="row gutters-5">
                                              <div class="col-md">
                                        <div class="form-group">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                    <input type="hidden" name="types[]" value="history_imagenew">
                                                    <input type="hidden" name="history_imagenew[]" class="selected-files" value="{{ json_decode(get_setting('history_imagenew'), true)[$key] }}">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="hidden" name="types[]" value="history_yearnew">
                                                <input type="text" class="form-control" placeholder="History Year" name="history_yearnew[]" value="{{ json_decode(get_setting('history_yearnew'), true)[$key] }}">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="hidden" name="types[]" value="history_descriptionnew">
                                                <input type="text" class="form-control" placeholder="History Description" name="history_descriptionnew[]" value="{{ json_decode(get_setting('history_descriptionnew'), true)[$key] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button
                            type="button"
                            class="btn btn-soft-secondary btn-sm"
                            data-toggle="add-more"
                            data-content='
                            <div class="row gutters-5">
                                            <div class="col-md">
                                  <div class="form-group">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="history_imagenew">
                                            <input type="hidden" name="history_imagenew[]" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="history_yearnew">
                                        <input type="text" class="form-control" placeholder="History Year" name="history_yearnew[]">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="history_descriptionnew">
                                        <input type="text" class="form-control" placeholder="History Description" name="history_descriptionnew[]">
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>'
                            data-target=".home-banner1-target">
                            {{ translate('Add New') }}
                        </button>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>



        @endsection