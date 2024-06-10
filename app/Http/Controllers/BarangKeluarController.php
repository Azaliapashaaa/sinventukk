<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $rsetBarangKeluar = BarangKeluar::with('barang')->latest()->paginate(10);
        return view('barangkeluar.index', compact('rsetBarangKeluar'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    public function create()
    {
        $abarangkeluar = Barang::all();
        return view('barangkeluar.create', compact('abarangkeluar'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_keluar'     => 'required|date',
            'qty_keluar'     => 'required|numeric|min:1',
            'barang_id'      => 'required|exists:barang,id',
        ]);

        // Ambil data barang berdasarkan barang_id
        $tgl_keluar = $request->tgl_keluar;
        $barang_id = $request->barang_id;

        // Periksa apakah tanggal keluar tidak lebih awal dari tanggal masuk
        $barangMasuk = BarangMasuk::where('barang_id', $barang_id)
        -> where('tgl_masuk', '>', $tgl_keluar)->exists();

        if ($barangMasuk) {
            return redirect()->back()->withInput()->withErrors(['tgl_keluar' => 'Tanggal keluar tidak boleh sebelum tanggal masuk barang!']);
        }
        
        $barang = Barang::find($request->barang_id);
        // Periksa apakah jumlah keluar melebihi stok yang ada
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Jumlah keluar melebihi stok yang ada!']);
        }

        // Buat record barang keluar
        BarangKeluar::create([
            'tgl_keluar'    => $request->tgl_keluar,
            'qty_keluar'    => $request->qty_keluar,
            'barang_id'     => $request->barang_id,
        ]);

        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    public function show($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        return view('barangkeluar.show', compact('barangKeluar'));
    }

    public function edit($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $abarangkeluar = Barang::all();
        return view('barangkeluar.edit', compact('barangKeluar', 'abarangkeluar'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|numeric|min:1',
            'barang_id'  => 'required|exists:barang,id',
        ]);

        $tgl_keluar = $request->tgl_keluar;
        $barang_id = $request->barang_id;

        // Periksa apakah tanggal keluar tidak lebih awal dari tanggal masuk
        $barangMasuk = BarangMasuk::where('barang_id', $barang_id)
        -> where('tgl_masuk', '>', $tgl_keluar)->exists();

        if ($barangMasuk) {
            return redirect()->back()->withInput()->withErrors(['tgl_keluar' => 'Tanggal keluar tidak boleh sebelum tanggal masuk barang!']);
        }
        
        $barang = Barang::find($request->barang_id);
        // Periksa apakah jumlah keluar melebihi stok yang ada
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Jumlah keluar melebihi stok yang ada!']);
        }

        $barangKeluar = BarangKeluar::findOrFail($id);

        $barangKeluar->update([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id'  => $request->barang_id,
        ]);

        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->delete();
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
