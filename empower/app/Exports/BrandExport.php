<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class BrandExport implements FromCollection, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Brand::orderBy('name', 'asc')->get(['name', 'id']);
    }

    public function title(): string
    {
        return 'Brands';
    }
}
