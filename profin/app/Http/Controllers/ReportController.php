<?php

namespace App\Http\Controllers;

use App\Models\FixedDeposit;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Reports\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactions_report(Request $request) {
        if ($request->isMethod('get')) {
            
            $data  = array();
            $date1 = date('Y-m-01');
            $date2 = date('Y-m-t');
            $data['date1'] = $date1;
            $data['date2'] = $date2;
            return view('backend.reports.transactions_report', $data);
        } else if ($request->isMethod('post')) {
            @ini_set('max_execution_time', 0);
            @set_time_limit(0);
            $data             = array();
            $date1            = isset($request->date1) ? date('Y-m-d', strtotime($request->date1)): date('Y-m-d');
            $date2            = $request->date2;
            $user_account     = isset($request->user_account) ? $request->user_account : [];
            $status           = isset($request->status) ? $request->status : '';
            $transaction_type = isset($request->transaction_type) ? $request->transaction_type : '';
            $currency_id = isset($request->currency_id) ? $request->currency_id : '';

            $accs = [];
            $i = 0;
            foreach($user_account as $ua) {

                $drAmount = (new ReportService)->getTransaction()->user($ua)->drCr('dr');
                $crAmount = (new ReportService)->getTransaction()->user($ua)->drCr('cr');

                

                if(isset($request->date1)) {
                    $drAmount = $drAmount->beforeCreatedAt($request->date1);
                    $crAmount = $crAmount->beforeCreatedAt($request->date1);
                }

                if(isset($request->currency_id)) {
                    $drAmount = $drAmount->currency($request->currency_id);
                    $crAmount = $crAmount->currency($request->currency_id);
                }

                if(isset($request->status)) {
                    $drAmount = $drAmount->status($request->status);
                    $crAmount = $crAmount->status($request->status);
                }

                if(isset($request->transaction_type)) {
                    $drAmount = $drAmount->type($request->transaction_type);
                    $crAmount = $crAmount->type($request->transaction_type);
                }

                $crAmount = $crAmount->sumAmount('amount');
                $drAmount = $drAmount->sumAmount('amount');

                

                $visData = Transaction::select('transactions.*')
                ->with(['user', 'currency'])
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                }, function ($query, $status) {
                    if ($status != '') {
                        return $query->where('status', $status);
                    }
                })
                ->when($transaction_type, function ($query, $transaction_type) {
                    return $query->where('type', $transaction_type);
                })
                ->when($ua, function ($query, $ua) {
                    return $query->whereHas('user', function ($query) use ($ua) {
                        return $query->where('id', $ua);
                    });
                });

                if(isset($request->currency_id)) {
                    $visData = $visData->where('currency_id', $currency_id);
                }

                $visData = $visData->whereRaw("date(transactions.created_at) >= '$date1' AND date(transactions.created_at) <= '$date2'")
                    ->orderBy('id', 'asc')
                    ->orderBy('user_id', 'asc')
                    ->get();

                $accs[$i]['user'] = User::find($ua);
                $accs[$i]['reports'] = $visData;
                $accs[$i]['crAmount'] = $crAmount;
                $accs[$i]['drAmount'] = $drAmount;
                $accs[$i]['closing_amount'] = $crAmount - $drAmount;

                $i++;
            }

            
            $data['report_data']      =  $accs;
            $data['date1']            = $request->date1;
            $data['date2']            = $request->date2;
            $data['status']           = $request->status;
            $data['user_account']     = $request->user_account;
            $data['vusers']     = User::whereIn('id', $request->user_account)->get();
            $data['transaction_type'] = $request->transaction_type;
            $data['currency_id'] = $request->currency_id;

            return view('backend.reports.transactions_report', $data);
        }

    }

    public function loan_report(Request $request) {
        if ($request->isMethod('get')) {
            return view('backend.reports.loan_report');
        } else if ($request->isMethod('post')) {
            @ini_set('max_execution_time', 0);
            @set_time_limit(0);

            $data         = array();
            $date1        = $request->date1;
            $date2        = $request->date2;
            $user_account = isset($request->user_account) ? $request->user_account : '';
            $status       = isset($request->status) ? $request->status : '';
            $loan_type    = isset($request->loan_type) ? $request->loan_type : '';

            $data['report_data'] = Loan::select('loans.*')
                ->with(['borrower', 'loan_product', 'currency'])
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                }, function ($query, $status) {
                    if ($status != '') {
                        return $query->where('status', $status);
                    }
                })
                ->when($loan_type, function ($query, $loan_type) {
                    return $query->where('loan_product_id', $loan_type);
                })
                ->when($user_account, function ($query, $user_account) {
                    return $query->whereHas('borrower', function ($query) use ($user_account) {
                        return $query->where('email', $user_account)
                            ->orWhere('account_number', $user_account);
                    });
                })
                ->whereRaw("date(loans.created_at) >= '$date1' AND date(loans.created_at) <= '$date2'")
                ->orderBy('id', 'desc')
                ->get();

            $data['date1']        = $request->date1;
            $data['date2']        = $request->date2;
            $data['status']       = $request->status;
            $data['user_account'] = $request->user_account;
            $data['loan_type']    = $request->loan_type;
            return view('backend.reports.loan_report', $data);
        }

    }

    public function fdr_report(Request $request) {
        if ($request->isMethod('get')) {
            return view('backend.reports.fdr_report');
        } else if ($request->isMethod('post')) {
            @ini_set('max_execution_time', 0);
            @set_time_limit(0);

            $data         = array();
            $date1        = $request->date1;
            $date2        = $request->date2;
            $user_account = isset($request->user_account) ? $request->user_account : '';
            $status       = isset($request->status) ? $request->status : '';
            $fdr_plan     = isset($request->fdr_plan) ? $request->fdr_plan : '';

            $data['report_data'] = FixedDeposit::select('fdrs.*')
                ->with(['plan', 'user', 'currency'])
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                }, function ($query, $status) {
                    if ($status != '') {
                        return $query->where('status', $status);
                    }
                })
                ->when($fdr_plan, function ($query, $fdr_plan) {
                    return $query->where('loan_product_id', $fdr_plan);
                })
                ->when($user_account, function ($query, $user_account) {
                    return $query->whereHas('user', function ($query) use ($user_account) {
                        return $query->where('email', $user_account)
                            ->orWhere('account_number', $user_account);
                    });
                })
                ->whereRaw("date(fdrs.created_at) >= '$date1' AND date(fdrs.created_at) <= '$date2'")
                ->orderBy('id', 'desc')
                ->get();

            $data['date1']        = $request->date1;
            $data['date2']        = $request->date2;
            $data['status']       = $request->status;
            $data['user_account'] = $request->user_account;
            $data['fdr_plan']     = $request->fdr_plan;
            return view('backend.reports.fdr_report', $data);
        }

    }

    public function bank_revenues(Request $request) {
        if ($request->isMethod('get')) {
            return view('backend.reports.bank_revenues');
        } else if ($request->isMethod('post')) {
            @ini_set('max_execution_time', 0);
            @set_time_limit(0);

            $data        = array();
            $year        = $request->year;
            $currency_id = $request->currency_id;

            $transaction_revenue = Transaction::selectRaw("CONCAT('Revenue from ', type), sum(fee) as amount")
                ->whereRaw("YEAR(created_at) = '$year'")
                ->where('fee', '!=', 0)
                ->where('status', 2)
                ->where('currency_id', $currency_id)
                ->groupBy('type');

            $data['report_data'] = LoanPayment::selectRaw("'Revenue from Loan' as type, sum(interest + late_penalties) as amount")
                ->whereRaw("YEAR(loan_payments.created_at) = '$year'")
                ->whereHas('loan', function ($query) use ($currency_id) {
                    return $query->where('currency_id', $currency_id);
                })
                ->union($transaction_revenue)
                ->get();

            $data['year']        = $request->year;
            $data['currency_id'] = $request->currency_id;
            return view('backend.reports.bank_revenues', $data);
        }

    }

    public function balance_sheet(Request $request) {
        if ($request->isMethod('get')) {
            return view('backend.reports.balance_sheet_report');

        } else if ($request->isMethod('post')) {
            @ini_set('max_execution_time', 0);
            @set_time_limit(0);

            $data        = array();
            $year        = $request->year;
            $currency_id = $request->currency_id;

            $transaction_revenue = Transaction::selectRaw("CONCAT('Revenue from ', type), sum(fee) as amount")
                ->whereRaw("YEAR(created_at) = '$year'")
                ->where('fee', '!=', 0)
                ->where('status', 2)
                ->where('currency_id', $currency_id)
                ->groupBy('type');

            $data['report_data'] = LoanPayment::selectRaw("'Revenue from Loan' as type, sum(interest + late_penalties) as amount")
                ->whereRaw("YEAR(loan_payments.created_at) = '$year'")
                ->whereHas('loan', function ($query) use ($currency_id) {
                    return $query->where('currency_id', $currency_id);
                })
                ->union($transaction_revenue)
                ->get();

            $data['year']        = $request->year;
            $data['currency_id'] = $request->currency_id;
            return view('backend.reports.bank_revenues', $data);
        }

    }

    public function searchUserByName(Request $request)
    {
        $search = $request->input('search');
       
        $users = User::where('user_type', 'customer')->where(function($query) use($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%');
        });
        $data = $users->paginate(10, ['*'], 'page', $request->page)->toArray();
        return $data;
    }

}