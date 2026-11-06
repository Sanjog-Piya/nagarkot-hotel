        @extends('backend.layouts.app')
@section('content')

        {{-- Home Slider --}}
            <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('About Company') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
              


    	                     <div class="form-group row">
    	                    <label class="col-md-3 col-from-label">{{translate('About Tab')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="about_tab">
        	                    <textarea type="text" name="about_tab" class="form-control aiz-text-editor" >{{  get_setting('about_tab') }}</textarea>
        					
                            </div>
    	                </div>
    	                 
    	                   <div class="form-group row">
    	                    <label class="col-md-3 col-from-label">{{translate('Vision Tab')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value=" vision_tab">
        	                    <textarea type="text" name=" vision_tab" class="form-control aiz-text-editor" >{{  get_setting(' vision_tab') }}</textarea>
        					
                            </div>
    	                </div>
    	                   <div class="form-group row">
    	                    <label class="col-md-3 col-from-label">{{translate('About Main Long Description')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="about_main_ldescription">
        	                    <textarea type="text" name="about_main_ldescription" class="form-control aiz-text-editor" >{{  get_setting('about_main_ldescription') }}</textarea>
        					
                            </div>
    	                </div>

    	                  <div class="form-group row">
    	                    <label class="col-md-3 col-from-label">{{translate('Mission Tab')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="m_tab">
        	                    <textarea type="text" name="m_tab" class="form-control aiz-text-editor" >{{  get_setting('m_tab') }}</textarea>
        					
                            </div>
    	                </div>


                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
        @endsection