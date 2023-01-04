<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Incoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IncomingController extends Controller
{
    public function postIncoming(Request $req)
    {
        $inValid = $req->validate([
            'kode_obat' => 'required',
            'kode_batch' => 'required',
            'supplier' => 'required',
            'jumlah' => 'numeric|required',
            'tgl_kadaluarsa' => 'date|required'
        ]);

        $obat = Drug::find($req->kode_obat);
        $obat->stok = (integer)$obat->stok + (integer)$req->jumlah;
        $obat->save();

        $inComing = new Incoming();
        $inComing->kode_obat = $req->kode_obat;
        $inComing->kode_batch = $req->kode_batch;
        $inComing->supplier = $req->supplier;
        $inComing->jumlah = $req->jumlah;
        $inComing->tgl_kadaluarsa = $req->tgl_kadaluarsa;
        $inComing->save();

        return Redirect::route('drugs.index');
    }
}
