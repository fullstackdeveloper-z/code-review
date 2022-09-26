@extends('layouts.app')

@section('content')

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

	<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
	<style>
		.kbw-signature { width: 100%; height: 200px;}
		#sig canvas{
			width: 100% !important;
			height: auto;
		}
		.scroll-box {
			overflow-y: scroll;
			width: 500px;
			height: 400px;
			margin: 0 auto;
		}
	</style>
	<div class="row">
		@foreach($loan_plans as $loan_plan)
			<div class="col-lg-3">
				<div class="card mb-4">
					<div class="card-header title">
						<div class="d-flex flex-wrap justify-content-between">
							<h6 class="card-title my-3">{{ $loan_plan->name }}</h6>
							<h6 class="card-title  my-3">{{ $loan_plan->interest_rate.' %' }}</h6>
						</div>
					</div>
					<div class="card-body content">
						<ul class="plan-feature-list pl-0">
							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Term') }}</span>
								<span>
									{{ $loan_plan->term }}
									@if($loan_plan->term_period === '+1 month')
										{{ _lang('Month') }}
									@elseif($loan_plan->term_period === '+1 year')
										{{ _lang('Year') }}
									@elseif($loan_plan->term_period === '+1 day')
										{{ _lang('Day') }}
									@elseif($loan_plan->term_period === '+1 week')
										{{ _lang('Week') }}
									@endif
								</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Interest Rate') }}</span>
								<span>{{ $loan_plan->interest_rate.' %' }}</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Interest Type') }}</span>
								<span>{{ ucwords(str_replace("_"," ", $loan_plan->interest_type)) }}</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Minimum') }}</span>
								<span>{{ decimalPlace($loan_plan->minimum_amount, currency()) }}</span>
							</li>

							<li class="d-flex flex-wrap justify-content-between">
								<span>{{ _lang('Maximum') }}</span>
								<span>{{ decimalPlace($loan_plan->maximum_amount, currency()) }}</span>
							</li>
						</ul>
					</div>
					<div class="card-footer">
						<a href="{{ route('loans.apply_loan') }}" class="btn btn-main btn-block bg-primary text-white">Apply this Loan</a>
					</div>
				</div>
			</div>
		@endforeach

	</div>
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Apply New Loan') }}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('loans.apply_loan') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Loan Product') }}</label>
								<select class="form-control auto-select select2" data-selected="{{ old('loan_product_id') }}" name="loan_product_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('loan_products','id','name',old('loan_product_id'), array('status=' => 1)) }}
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Currency') }}</label>
								<select class="form-control auto-select" data-selected="{{ old('currency_id') }}" name="currency_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('currency','id','name','',array('status=' => 1)) }}
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('First Payment Date') }}</label>
								<input type="text" class="form-control datepicker" name="first_payment_date" value="{{ old('first_payment_date') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Applied Amount') }}</label>
								<input type="text" class="form-control float-field" name="applied_amount" value="{{ old('applied_amount') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Attachment') }}</label>
								<input type="file" class="trickycode-file" name="attachment">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Description') }}</label>
								<textarea class="form-control" name="description">{{ old('description') }}</textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Remarks') }}</label>
								<textarea class="form-control" name="remarks">{{ old('remarks') }}</textarea>
							</div>
						</div>
{{--						<div class="col-md-12">--}}
{{--							<div class="form-check">--}}
{{--								<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">--}}
{{--								<label class="form-check-label" for="flexCheckDefault">--}}
{{--									Default checkbox--}}
{{--								</label>--}}
{{--							</div>--}}
{{--						</div>--}}

						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Submit Application') }}</button>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">Loan Agreement</span>
			</div>
			<div class="card-body">
				<div class="overflow-auto">
					<div class="scroll-box">
						<h2>Agreement</h2>
						<p>Provident minima cum quia commodi. Exercitationem suscipit deserunt impedit quod omnis unde. Fuga nobis perspiciatis nisi harum. Assumenda natus laborum voluptatum itaque deleniti earum ad, necessitatibus distinctio qui quo? Facilis. Quos mollitia
							esse nisi dolorem vero porro repudiandae hic impedit ea totam inventore, eum, ipsum illo, aliquid voluptatibus rem at autem unde optio! Quibusdam nesciunt magni et dolorum nemo natus?</p>
						<p>Provident minima cum quia commodi. Exercitationem suscipit deserunt impedit quod omnis unde. Fuga nobis perspiciatis nisi harum. Assumenda natus laborum voluptatum itaque deleniti earum ad, necessitatibus distinctio qui quo? Facilis. Quos mollitia
							esse nisi dolorem vero porro repudiandae hic impedit ea totam inventore, eum, ipsum illo, aliquid voluptatibus rem at autem unde optio! Quibusdam nesciunt magni et dolorum nemo natus?</p>
						<h3>Your Responsibility</h3>
						<p>Provident minima cum quia commodi. Exercitationem suscipit deserunt impedit quod omnis unde. Fuga nobis perspiciatis nisi harum. Assumenda natus laborum voluptatum itaque deleniti earum ad, necessitatibus distinctio qui quo? Facilis. Quos mollitia
							esse nisi dolorem vero porro repudiandae hic impedit ea totam inventore, eum, ipsum illo, aliquid voluptatibus rem at autem unde optio! Quibusdam nesciunt magni et dolorum nemo natus?</p>
						<p>Provident minima cum quia commodi. Exercitationem suscipit deserunt impedit quod omnis unde. Fuga nobis perspiciatis nisi harum. Assumenda natus laborum voluptatum itaque deleniti earum ad, necessitatibus distinctio qui quo? Facilis. Quos mollitia
							esse nisi dolorem vero porro repudiandae hic impedit ea totam inventore, eum, ipsum illo, aliquid voluptatibus rem at autem unde optio! Quibusdam nesciunt magni et dolorum nemo natus?</p>
						<h3>Our Responsibility</h3>
						<p>Provident minima cum quia commodi. Exercitationem suscipit deserunt impedit quod omnis unde. Fuga nobis perspiciatis nisi harum. Assumenda natus laborum voluptatum itaque deleniti earum ad, necessitatibus distinctio qui quo? Facilis. Quos mollitia
							esse nisi dolorem vero porro repudiandae hic impedit ea totam inventore, eum, ipsum illo, aliquid voluptatibus rem at autem unde optio! Quibusdam nesciunt magni et dolorum nemo natus?</p>
						<p>Provident minima cum quia commodi. Exercitationem suscipit deserunt impedit quod omnis unde. Fuga nobis perspiciatis nisi harum. Assumenda natus laborum voluptatum itaque deleniti earum ad, necessitatibus distinctio qui quo? Facilis. Quos mollitia
							esse nisi dolorem vero porro repudiandae hic impedit ea totam inventore, eum, ipsum illo, aliquid voluptatibus rem at autem unde optio! Quibusdam nesciunt magni et dolorum nemo natus?</p>

					</div>

				</div>

				<div class="row">
					<div class="col-md-12">
						<label class="" for="">Signature:</label>
						<br/>
						<div id="sig" ></div>
						<br/>
						<button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
						<textarea required id="signature64" name="signed" style="display: none"></textarea>
					</div>
				</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
		$('#clear').click(function(e) {
			e.preventDefault();
			sig.signature('clear');
			$("#signature64").val('');
		});
	</script>
@endsection
