<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRScannerController extends Controller
{
    public function index()
    {
        return view('scanner');
    }

    public function scanResult(Request $request)
    {
        $qrData = $request->input('qrData');
        // Process the QR data as needed
        return view('qr-scan-result', ['qrData' => $qrData]);
    }
}