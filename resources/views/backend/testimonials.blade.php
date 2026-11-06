        @extends('backend.layouts.app')
@section('content')

        {{-- Home Slider --}}
            <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Testimonials') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ translate('Testimonials') }}</label>
                        <div class="home-banner1-target">
                            <input type="hidden" name="types[]" value="testimage">
                            <input type="hidden" name="types[]" value="testtitle">
                            <input type="hidden" name="types[]" value="testpara">
                               <input type="hidden" name="types[]" value="testposition">
                            @if (get_setting('testimage') != null)
                                @foreach (json_decode(get_setting('testimage'), true) as $key => $value)
                                    <div class="row gutters-5">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                    <input type="hidden" name="types[]" value="testimage">
                                                    <input type="hidden" name="testimage[]" class="selected-files" value="{{ json_decode(get_setting('testimage'), true)[$key] }}">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="hidden" name="types[]" value="testtitle">
                                                <input type="text" class="form-control" placeholder="Testimonials Title" name="testtitle[]" value="{{ json_decode(get_setting('testtitle'), true)[$key] }}">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="hidden" name="types[]" value="testpara">
                                                <input type="text" class="form-control" placeholder="Testimonials Paragraph" name="testpara[]" value="{{ json_decode(get_setting('testpara'), true)[$key] }}">
                                            </div>
                                        </div>
                                          <div class="col-md">
                                            <div class="form-group">
                                                <input type="hidden" name="types[]" value="testposition">
                                                <input type="text" class="form-control" placeholder="Testimonials Position" name="testposition[]" value="{{ json_decode(get_setting('testposition'), true)[$key] }}">
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
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="testimage">
                                            <input type="hidden" name="testimage[]" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="testtitle">
                                        <input type="text" class="form-control" placeholder="Testimonials Title" name="testtitle[]">
                                    </div>
                                </div>
                                    <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="testpara">
                                        <input type="text" class="form-control" placeholder="Testimonials Paragraph" name="testpara[]">
                                    </div>
                                </div>
                                   <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="testposition">
                                        <input type="text" class="form-control" placeholder="Testimonials Position" name="testposition[]">
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