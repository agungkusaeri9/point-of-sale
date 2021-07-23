<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function salePrint()
    {
        $pdf = App::make('dompdf.wrapper');
        $sales = Sale::orderBy('id','DESC')->get();
        $pdf->loadView('pages.reports.sales.print',['sales' => $sales]);
        return $pdf->stream();
    }

    public function saleExport() 
    {
        return Excel::download(new SaleExport, 'laporan penjualan.xlsx');
    }
}
