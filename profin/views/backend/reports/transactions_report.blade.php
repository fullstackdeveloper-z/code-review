@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Transactions Report') }}</span>
			</div>

			<div class="card-body">

				<div class="report-params">
					<form class="validate" method="post" action="{{ route('reports.transactions_report') }}">
						<div class="row">
              				{{ csrf_field() }}

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Start Date') }}</label>
									<input type="text" class="form-control datepicker" name="date1" id="date1" value="{{ isset($date1) ? $date1 : old('date1') }}" readOnly="true" required>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('End Date') }}</label>
									<input type="text" class="form-control datepicker" name="date2" id="date2" value="{{ isset($date2) ? $date2 : old('date2') }}" readOnly="true" required>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
								<label class="control-label">{{ _lang('Type') }}</label>
									<select class="form-control auto-select" data-selected="{{ isset($transaction_type) ? $transaction_type : old('transaction_type') }}" name="transaction_type">
										<option value="">{{ _lang('All') }}</option>
										<option value="Deposit">{{ _lang('Deposit') }}</option>
										<option value="Withdraw">{{ _lang('Withdraw') }}</option>
										<option value="Wire_Transfer">{{ _lang('Wire Transfer') }}</option>
										<option value="Payment">{{ _lang('Payment') }}</option>
										<option value="Loan">{{ _lang('Loan') }}</option>
                                        <option value="Loan_Repayment">{{ _lang('Loan Repayment') }}</option>
										<option value="Exchange">{{ _lang('Exchange') }}</option>
										<option value="Fixed_Deposit">{{ _lang('Fixed Deposit') }}</option>
									</select>
								</div>
							</div>

                            <div class="col-xl-2 col-lg-4">
								<div class="form-group">
								<label class="control-label">{{ _lang('Status') }}</label>
									<select class="form-control auto-select" data-selected="{{ isset($status) ? $status : old('status') }}" name="status">
										<option value="">{{ _lang('All') }}</option>
										<option value="1">{{ _lang('Pending') }}</option>
										<option value="2">{{ _lang('Completed') }}</option>
										<option value="0">{{ _lang('Cancelled') }}</option>
									</select>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('User Account') }}</label>
									<select class="form-control users_select" name="user_account[]" multiple value='{{ isset($user_account) ? json_encode($user_account) : json_encode(old('user_account')) }}' data-value='{{ isset($user_account) ? json_encode($user_account) : json_encode(old('user_account')) }}'>
										@if(isset($vusers))
											@forelse ($vusers as $u)
												<option value="{{ $u->id }}" selected>{{ $u->name }}</option>
											@empty
												
											@endforelse
										@endif
									</select>
								</div>
							</div>
							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Currency') }}</label>
									<select class="form-control auto-select" data-selected="{{ isset($currency_id) ? $currency_id : old('currency_id') }}" name="currency_id">
										@forelse (getCurrencies() as $cur)
										<option value="{{ $cur->id }}">{{ $cur->name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<button type="submit" class="btn btn-light btn-sm btn-block mt-26"><i class="icofont-filter"></i> {{ _lang('Filter') }}</button>
							</div>
						</form>

					</div>
				</div><!--End Report param-->

				@php $date_format = get_option('date_format','Y-m-d'); @endphp
				@php 
					$currency = currency();
					// dd($currency)
				@endphp

				<div class="report-header">
				   <h4>{{ _lang('Transactions Report') }}</h4>
				   <h5>{{ isset($date1) ? date($date_format, strtotime($date1)).' '._lang('to').' '.date($date_format, strtotime($date2)) : '----------  '._lang('to').'  ----------' }}</h5>
				</div>
				@if(isset($report_data))
					@forelse ($report_data as $rp)
						<h2>{{ $rp['user']->name }}</h2>
						
						<table class="table table-bordered report-table">
							<thead>
								<tr>
								<th>{{ _lang('Date') }}</th>
								<th>{{ _lang('User') }}</th>
								{{--                        <th>{{ _lang('AC Number') }}</th>--}}
								{{--                        <th>{{ _lang('Currency') }}</th>--}}
								<th>{{ _lang('Amount') }}</th>
								<th>{{ _lang('Charge') }}</th>
								<th>{{ _lang('Grand Total') }}</th>
								<th>{{ _lang('DR/CR') }}</th>
								<th>{{ _lang('Running Balance') }}</th>
								<th>{{ _lang('Type') }}</th>
								<th>{{ _lang('Status') }}</th>
								<th class="text-center">{{ _lang('Details') }}</th>
							</tr>
								@php
									$openingdate = date($date_format, strtotime($date1));
									$closingdate = date($date_format, strtotime($date2));
									$balance = $rp['closing_amount'];
								@endphp
								<tr>
									<td>{{date($date_format, strtotime($date1))}}</td>
									<td >Opening Balance</td>
									<td></td>
									<td></td>
									<td></td>
									<td>DR</td>
									<td>{{ $balance }}</td>
									<td ></td>
									<td></td>
									<td></td>


								</tr>
							</thead>
							<tbody>
							@if(isset($rp['reports']))
								
								@foreach($rp['reports'] as $transaction)
									@php
									$symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
									$class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
									$class2  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
									@endphp
									<tr>
										<td>{{ $transaction->created_at }}</td>
										<td>
											{{ $transaction->user->name }}<br/>
											{{ $transaction->user->email }}<br/>
										</td>
										{{--								<td>{{ $transaction->user->account_number }}</td>--}}
										{{--								<td>{{ $transaction->currency->name }}</td>--}}
										@if($transaction->dr_cr == 'dr')
											<td>{{ decimalPlace(($transaction->amount - $transaction->fee), currency($transaction->currency->name)) }}</td>
										@else
											<td>{{ decimalPlace(($transaction->amount + $transaction->fee), currency($transaction->currency->name)) }}</td>
										@endif
										<td>{{ $transaction->dr_cr == 'dr' ? '+ '.decimalPlace($transaction->fee, currency($transaction->currency->name)) : '- '.decimalPlace($transaction->fee, currency($transaction->currency->name)) }}</td>
										<td><span class="{{ $class }}">{{ $symbol.' '.decimalPlace($transaction->amount, currency($transaction->currency->name)) }}</span></td>
										<td>{{ strtoupper($transaction->dr_cr) }}</td>
										<td>
											@php
												$value = $transaction->amount;
												if($transaction->dr_cr == 'dr') {
													$balance -= $value;
												} else {
													$balance += $value;
												}
												$symbol2  = $balance < 0 ? '-' : '+';
												$class2  = $balance < 0 ? 'text-danger' : 'text-success';
											@endphp
											<span class="{{ $class2 }}">

												{{ $symbol2.' '.decimalPlace(abs($balance)) }}

											</span>
										</td>
										<td>{{ str_replace('_',' ',$transaction->type) }}</td>
										<td>{!! xss_clean(transaction_status($transaction->status)) !!}</td>
										<td class="text-center"><a href="{{ action('TransferRequestController@show', $transaction->id) }}" data-title="{{ _lang('Transaction Details') }}" class="btn btn-outline-primary btn-sm ajax-modal">{{ _lang('View') }}</a></td>
									</tr>
								@endforeach
								<tfoot>
									<tr>
											<td>{{$closingdate}}</td>
											<td >Closing Balance</td>
											<td ></td>
											<td></td>
											<td></td>
											<td>DR</td>
											<td>
												@php
													$symbol2  = $balance < 0 ? '-' : '+';
													$class2  = $balance < 0 ? 'text-danger' : 'text-success';
												@endphp
												<span class="{{ $class2 ?? '' }}">
		
													{{ $symbol2.' '.decimalPlace($balance) }}
		
												</span>
											</td>
											<td ></td>
											<td></td>
											<td></td>
									</tr>
								</tfoot>
							@endif
							</tbody>
						</table>
						<br>
					@empty
						
					@endforelse
				@endif
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-script')
	<script>
		var d = new Date();
		var currMonth = d.getMonth();
		var currYear = d.getFullYear();
		var startDate = new Date(currYear, currMonth, 1);

		$(".datepicker1").daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			startDate: startDate,
			locale: {
			format: "DD/MM/YYYY",
			},
		});


		$('.users_select').select2({
                ajax: {
                    url: '{{  route('search.user.name')  }}',
                    dataType: 'json',
                    data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.current_page || 1
                    }

                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                    },
                    processResults: function(data, params) {
                        params.current_page = (data.current_page + 1) || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: (params.current_page) <= data.last_page
                            }
                        };
                    },
                    autoWidth: true,
                    cache: true
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                },
                multiple: true,
                delay: 250,
                placeholder: 'Search for User',
                // minimumInputLength: 1,
                templateResult: formatProduct,
                templateSelection: formatProductSelection

            });


			function formatProduct(product) {
                if (product.loading) {
                    return product.text;
                }

                var $container = $(
                    "<div class='select2-result-product clearfix'>" +
                    "<div class='select2-result-product__title'></div>" +
                    "<div class='select2-result-product__description'></div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-product__title").text(product.name);
                $container.find(".select2-result-product__description").text(product.description);

                return $container;
            }
            function formatProductSelection(product) {
                return product.name || product.text;
            }
	</script>
@endsection