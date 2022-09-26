<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class ShippingTypeExport implements FromArray, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [['flat_rate'], ['free']];
    }

    public function title(): string
    {
        return 'ShippingType';
    }
}
