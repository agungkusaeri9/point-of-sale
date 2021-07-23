<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SaleExport implements FromView, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view() : View
    {
        $sales = Sale::with('user','customer')->orderBy('id','DESC')->get();
        return view('pages.reports.sales.export',[
            'sales' => $sales
        ]);
    }

    public function headings(): array
    {
        return [
            ['Laporan Penjualan'],
            [
                'A1',
                'B1',
                'C1',
                'D1',
                'E1',
                'F1',
                'G1',
                'H1',
                'I1'
            ]
        ];
    }

}
