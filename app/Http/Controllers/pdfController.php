<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use PDF;

class pdfController extends Controller
{
    public function show($id)
    {
        $pengaduan = Pengaduan::find($id);
        $pdf = PDF::loadView('pdfview', compact('pengaduan'));
        $filename = 'Resi-Pengaduan_' . $pengaduan->nama . '.pdf';
        return $pdf->stream($filename);
    }

    // public function downloadPDF($id)
    // {
    //     $pengaduans = Pengaduan::find($id);
    //     $pdf = PDF::loadView('pdfview', compact('pengaduans'));
    //     return $pdf->download('pengaduans' . $id . '.pdf');
    // }
}
