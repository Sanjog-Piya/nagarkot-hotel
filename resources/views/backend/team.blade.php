        @extends('backend.layouts.app')
@section('content')

        {{-- Home Slider --}}
            <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Team') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ translate('Team') }}</label>
                        <div class="home-banner1-target">
                            <input type="hidden" name="types[]" value="teamimage">
                            <input type="hidden" name="types[]" value="teamtitle">
                            <input type="hidden" name="types[]" value="teampara">
                               <input type="hidden" name="types[]" value="teamposition">
                            @if (get_setting('teamimage') != null)
                                @foreach (json_decode(get_setting('teamimage'), true) as $key => $value)
                                    <div class="row gutters-5">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                    <input type="hidden" name="types[]" value="teamimage">
                                                    <input type="hidden" name="teamimage[]" class="selected-files" value="{{ json_decode(get_setting('teamimage'), true)[$key] }}">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="hidden" name="types[]" value="teamtitle">
                                                <input type="text" class="form-control" placeholder="Testimonials Title" name="teamtitle[]" value="{{ json_decode(get_setting('teamtitle'), true)[$key] }}">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="hidden" name="types[]" value="teampara">
                                                <input type="text" class="form-control" placeholder="Testimonials Paragraph" name="teampara[]" value="{{ json_decode(get_setting('teampara'), true)[$key] }}">
                                            </div>
                                        </div>
                                          <div class="col-md">
                                            <div class="form-group">
                                                <input type="hidden" name="types[]" value="teamposition">
                                                <input type="text" class="form-control" placeholder="Testimonials Position" name="teamposition[]" value="{{ json_decode(get_setting('teamposition'), true)[$key] }}">
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
                                            <input type="hidden" name="types[]" value="teamimage">
                                            <input type="hidden" name="teamimage[]" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="teamtitle">
                                        <input type="text" class="form-control" placeholder="Testimonials Title" name="teamtitle[]">
                                    </div>
                                </div>
                                    <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="teampara">
                                        <input type="text" class="form-control" placeholder="Testimonials Paragraph" name="teampara[]">
                                    </div>
                                </div>
                                   <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="teamposition">
                                        <input type="text" class="form-control" placeholder="Testimonials Position" name="teamposition[]">
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