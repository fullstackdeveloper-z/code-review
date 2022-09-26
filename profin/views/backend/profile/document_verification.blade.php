@extends('layouts.app')

@section('content')
<div class="row">
	
	@if(Auth::user()->user_type == 'customer' && Auth::user()->document_submitted_at != null)	
		<div class="col-lg-12">
			<div class="alert alert-danger text-center">
				<span>{{ _lang('You have already submit your documents ! You will be notified soon after reviewing your documents.') }}</span>
			</div>
		</div>
	@else

	<div class="col-lg-6 ">
		<div class="card">
			<div class="card-header text-center">
				{{ _lang('KYC Verification') }}
			</div>

			<div class="card-body">
				<form action="{{ route('profile.document_verification') }}" autocomplete="off" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="control-label">Type</label>
								<select class="form-control">
									<option>Business</option>
									<option>Individual</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Company Name</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">ABN</label>
{{--								<div class="input-group">--}}
{{--									<div class="input-group-prepend">--}}
{{--										<span class="input-group-text" id="inputGroupPrepend3">ABN</span>--}}
{{--									</div>--}}
									<input type="text" class="form-control">
{{--								</div>--}}
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Date of Birth</label>
								<input type="date" class="form-control">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('IDENTITY VERIFICATION') }}</label>
								<input type="file" class="form-control dropify" name="identity_verification" required>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="control-label">Residential Address</label>
								<input type="text" class="form-control"required>
							</div>
						</div>

            			<div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('ADDRESS VERIFICATION') }}</label>
								<input type="file" class="form-control dropify" name="address_verification" required>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"><i class="icofont-check-circled"></i> {{ _lang('Submit') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header text-center">
					KYC Explained
				</div>

				<div class="card-body">
					<p>
						For individual customers, this information includes, as a minimum requirement, their full name as well as either their residential address or date of birth. There are procedures for identifying customers who do not have conventional forms of identification in rare circumstances.
					</p><br><p>
						For customers who aren’t individuals, you must collect information so that you are reasonably satisfied the customer actually exists. For example, if the customer is a company in Australia you must collect and verify information including the full name of the company, whether it is registered with the Australian Securities & Investments Commission (ASIC) as a public or proprietary company, and its Australian Company Number (ACN) or Australian Registered Body Number (ARBN).
					</p>
					<a class="btn btn-primary">Learn More</a>
				</div>
			</div>
		</div>
	@endif
</div>
@endsection

