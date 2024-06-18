<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use DB;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::latest();

        if ($request->filled('search')) {
            $query->where('merk', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('seri', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('stok', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('kategori_id', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('spesifikasi', 'like', '%' . $request->input('search') . '%');

        }

        $rsetBarang = $query->paginate(10);

        return view('view_barang.index', compact('rsetBarang'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $akategori = Kategori::all();
        return view('view_barang.create', compact('akategori'));
    }

    public function store(Request $request)
    {
        // Validate form
        $this->validate($request, [
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            'kategori_id' => 'required',
        ]);

        Barang::create([
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
            'kategori_id' => $request->kategori_id,
        ]);

        // Redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsetBarang = Barang::find($id);

        // Return view
        return view('view_barang.show', compact('rsetBarang'));
    }

    public function edit(string $id)
    {
        $akategori = array('blank' => 'Pilih Kategori', 'M' => 'M', 'A' => 'A', 'BHP' => 'BHP', 'BTHP' => 'BTHP');
        $rsetBarang = Barang::find($id);
        return view('view_barang.edit', compact('rsetBarang', 'akategori'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
        ]);

        $rsetBarang = Barang::find($id);

        $rsetBarang->update([
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
        ]);

        // Redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Barang Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        // Temukan barang berdasarkan ID
        $barang = Barang::findOrFail($id);
        // Periksa apakah stok barang masih ada
        if ($barang->stok > 0) {
            return redirect()->route('barang.index')->with(['error' => 'Barang tidak dapat dihapus karena masih memiliki stok.']);
        }

        // Jika stok barang 0, lakukan penghapusan
        $barang->delete();

        return redirect()->route('barang.index')->with(['success' => 'Barang berhasil dihapus.']);
    }
}
