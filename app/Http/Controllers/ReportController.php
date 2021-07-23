<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReportController extends Controller
{
    public function sale()
    {
        $pdf = App::make('dompdf.wrapper');
        $sales = Sale::orderBy('id','DESC')->get();
        $pdf->loadView('pages.transactions.report.sale',['sales' => $sales]);
        return $pdf->stream();
    }
}
