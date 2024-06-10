<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar; // Corrected model name to match common naming conventions
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $rsetBarangMasuk = BarangMasuk::with('barang')->latest()->paginate(10);
        return view('barangmasuk.index', compact('rsetBarangMasuk'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    public function create()
    {
        $abarangmasuk = Barang::all();
        return view('barangmasuk.create', compact('abarangmasuk'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required',
            'barang_id' => 'required',
        ]);

        BarangMasuk::create([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
            'barang_id' => $request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.show', compact('barangMasuk'));
    }

    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $abarangmasuk = Barang::all();

        return view('barangmasuk.edit', compact('barangMasuk', 'abarangmasuk'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required',
            'barang_id' => 'required',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        $barangMasuk->update([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
            'barang_id' => $request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        // Find the BarangMasuk record
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Check if there are any related BarangKeluar records
        $barangKeluar = BarangKeluar::where('barang_id', $barangMasuk->barang_id)->first();

        if ($barangKeluar) {
            // If a related BarangKeluar record is found, do not delete and return an error message
            return redirect()->route('barangmasuk.index')->withErrors(['error' => 'Data barang masuk tidak dapat dihapus karena barang tersebut sudah digunakan dalam barang keluar.']);
        }

        // If no related BarangKeluar record is found, delete the BarangMasuk record
        $barangMasuk->delete();

        // Redirect to the index route with a success message
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
