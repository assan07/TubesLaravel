<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $pembayarans = \App\Models\Pembayaran::with('user')->latest()->paginate(10);
        return view('bendahara.cekPembayaran', compact('pembayarans'));
    }
}
