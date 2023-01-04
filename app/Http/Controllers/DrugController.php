<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DrugController extends Controller
{
    public function index()
    {
        $drugs = Drug::with('jenisObat')->get();

        return Inertia::render('Drugs/Drug', [
            'drugs' => $drugs
        ]);
    }

    public function postObat(Request $req)
    {
        $validate = $req->validate([
            'nama' => 'alpha_num|required',
            'jenis' => 'required',
            'satuan' => 'required',
            'harga_beli' => 'numeric|required',
            'harga_jual' => 'required|numeric'
        ]);

        $drug = new Drug;
        $drug->nama = $req->nama;
        $drug->jenis = $req->jenis;
        $drug->satuan = $req->satuan;
        $drug->harga_beli = $req->harga_beli;
        $drug->harga_jual = $req->harga_jual;
        $drug->stok = 0;
        $drug->save();

        return Redirect::route('drugs.index');
    }
}
