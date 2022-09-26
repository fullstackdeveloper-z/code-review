@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Balance Sheet') }}</span>
			</div>

			<div class="card-body">

				<div class="report-params">
					<form class="validate" method="post" action="{{ route('reports.transactions_report') }}">
						<div class="row">
              				{{ csrf_field() }}


							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('Date') }}</label>
									<input type="text" class="form-control datepicker" name="date2" id="date2" value="{{ isset($date2) ? $date2 : old('date2') }}" readOnly="true" required>
								</div>
							</div>


                            <div class="col-xl-2 col-lg-4">
								<div class="form-group">
								<label class="control-label">{{ _lang('Type') }}</label>
									<select class="form-control auto-select" data-selected="{{ isset($status) ? $status : old('status') }}" name="status">
										<option value="1">{{ _lang('Accrual') }}</option>
										<option value="">{{ _lang('Cash') }}</option>
									</select>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label">{{ _lang('User Account') }}</label>
									<input type="text" class="form-control" name="user_account" value="{{ isset($user_account) ? $user_account : old('user_account') }}">
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<button type="submit" class="btn btn-light btn-sm btn-block mt-26"><i class="icofont-filter"></i> {{ _lang('Run Report') }}</button>
							</div>
						</form>

					</div>
				</div><!--End Report param-->

				@php $date_format = get_option('date_format','Y-m-d'); @endphp
				@php $currency = currency(); @endphp
				<div class="report-header">
				   <h4>{{ _lang('Balance Sheet') }}</h4>
				   <h5>{{ isset($date1) ? date($date_format, strtotime($date1)).' '._lang('to').' '.date($date_format, strtotime($date2)) : '----------  '._lang('to').'  ----------' }}</h5>
				</div>
			<div class="row">
				<div class="col-6">
				{{--		Assets Table			--}}

				{{--		Current Assets			--}}
				<table class="table table-bordered">
					<thead>
                        <th>{{ _lang('No.') }}</th>
                        <th>{{ _lang('Account Name') }}</th>
                        <th>{{ _lang('Balance') }}</th>
					</thead>
					<tr class="table-info">
						<td colspan="3">Current Assets</td>
					</tr>
					<tbody>
					<tr>
						<td width="10%">1001</td>
						<td>Cash at Bank</td>
						<td><a href="#">$650</a></td>
					</tr>
					<tr>
						<td width="10%">1001</td>
						<td>Deposits Receivable</td>
						<td><a href="#">$650</a></td>
					</tr>
					<tr>
						<td width="10%">1001</td>
						<td>Loans Receivable (<12 Months)</td>
						<td><a href="#">$650</a></td>
					</tr>
					<tr class="bold">
						<td colspan="2">Total Current Assets</td>
						<td>$1650</td>
					</tr>
					<tr class="table-info">
						<td colspan="3">Non-Current Assets</td>
					</tr>
					<tr>
						<td width="10%">1001</td>
						<td>Loans Receivable (>12 months)</td>
						<td><a href="#">$650</a></td>
					</tr>
					<tr>
						<td width="10%">1001</td>
						<td></td>
						<td><a href="#">$650</a></td>
					</tr>
					<tr>
						<td width="10%">1001</td>
						<td>...</td>
						<td><a href="#">$650</a></td>
					</tr>
					<tr class="text-bold">
						<td colspan="2">Total Non-Current Assets</td>
						<td>$1650</td>
					</tr>
					</tbody>
					<tfoot>
					<tr class="bold table-success">
						<td colspan="2">Total</td>
						<td>$1650</td>
					</tr>
					</tfoot>
				</table>
				</div>



				<div class="col-6">
					<table class="table table-bordered">
						<thead>
						<th>{{ _lang('No.') }}</th>
						<th>{{ _lang('Account Name') }}</th>
						<th>{{ _lang('Balance') }}</th>
						</thead>
						<tr class="table-info">
							<td colspan="3">Current Liabilities</td>
						</tr>
						<tbody>
						<tr>
							<td width="10%">1001</td>
							<td>Client Balances</td>
							<td><a href="#">$650</a></td>
						</tr>
						<tr>
							<td width="10%">1001</td>
							<td>Withdrawals Payable</td>
							<td><a href="#">$650</a></td>
						</tr>
						<tr>
							<td width="10%">1001</td>
							<td>Fixed Deposits Payable (<12 Months)</td>
							<td><a href="#">$650</a></td>
						</tr>
						<tr class="bold">
							<td colspan="2">Total Current Liabilities</td>
							<td>$1650</td>
						</tr>
						<tr class="table-info">
							<td colspan="3">Non-Current Liabilities</td>
						</tr>
						<tr>
							<td width="10%">1001</td>
							<td>Fixed Deposits Payable (>12 Months)</td>
							<td><a href="#">$650</a></td>
						</tr>
						<tr>
							<td width="10%">1001</td>
							<td>...</td>
							<td><a href="#">$650</a></td>
						</tr>
						<tr>
							<td width="10%">1001</td>
							<td>...</td>
							<td><a href="#">$650</a></td>
						</tr>
						<tr class="text-bold">
							<td colspan="2">Total Non-Current Liabilities</td>
							<td>$1650</td>
						</tr>
						</tbody>
						<tfoot>
						<tr class="bold table-danger">
							<td colspan="2">Total</td>
							<td>$1650</td>
						</tr>
						</tfoot>
					</table>

			</div>
			</div>
		</div>
	</div>
</div>

@endsection