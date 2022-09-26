<?php

namespace App\Exports;

use App\Models\User;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class SellerExport implements FromCollection, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->user_type == 'seller') {
            return User::where(['user_type'=> 'seller', 'id'=> Auth::user()->id ])->get(['name', 'id', 'email']);
        }
        else {
            return User::where('user_type','seller')->get(['name', 'id', 'email']);
        }
    }

    public function title(): string
    {
        return 'Sellers';
    }
}
