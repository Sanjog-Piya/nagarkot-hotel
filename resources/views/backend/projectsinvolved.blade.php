		@extends('backend.layouts.app')
@section('content')

		{{-- Home Slider --}}
			<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Projects Involved') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Projects Involved') }}</label>
						<div class="home-banner1-target">
							<input type="hidden" name="types[]" value="project_number">
							<input type="hidden" name="types[]" value="project_title">
							@if (get_setting('project_number') != null)
								@foreach (json_decode(get_setting('project_number'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="project_number">
												<input type="text" class="form-control" placeholder="Project Number" name="project_number[]" value="{{ json_decode(get_setting('project_number'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="project_title">
												<input type="text" class="form-control" placeholder="Project Title" name="project_title[]" value="{{ json_decode(get_setting('project_title'), true)[$key] }}">
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
										<input type="hidden" name="types[]" value="project_number">
										<input type="text" class="form-control" placeholder="Project Number" name="project_number[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="project_title">
										<input type="text" class="form-control" placeholder="Project Title" name="project_title[]">
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