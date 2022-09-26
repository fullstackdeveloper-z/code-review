<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class TaxTypeExport implements FromArray, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [ ["amount"], ["percent"]];
    }

    public function title(): string
    {
        return "TaxType";
    }
}
