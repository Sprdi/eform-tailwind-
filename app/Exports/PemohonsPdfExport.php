<?php

namespace App\Exports;

use App\Models\Pemohon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;

class PemohonsPdfExport
{
    public function export()
    {
        $pemohons = Pemohon::all();
        $pdf = Pdf::loadView('exports.pemohons', compact('pemohons'))->setPaper('a4', 'landscape');
        return $pdf->download('pemohons.pdf');
    }
}
